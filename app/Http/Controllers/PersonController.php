<?php

namespace App\Http\Controllers;

use App\Helpers\PersonHelper;
use App\Partner;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        $search = session()->has('search') ? session('search') : '';
        $contentTitle = 'Orang';
        $people = Person::when($search != '', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
            $query->orWhere('nickname', 'LIKE', "%$search%");
        })->latest()->paginate(20);
        return view('content.bfr-person-list', compact('contentTitle', 'people', 'search'));
    }

    public function show($id)
    {
        $contentTitle = 'Orang';
        $person = Person::find($id);
        $siblings1 = $person->father_id ? Person::where('father_id', $person->father_id)->where('id', '!=', $person->id)->orderBy('child_number')->get()->toArray() : [];
        $siblings2 = $person->mother_id ? Person::where('mother_id', $person->mother_id)->where('id', '!=', $person->id)->orderBy('child_number')->get()->toArray() : [];
        $allSiblings = array_merge($siblings1, $siblings2);

        //Remove dupplicate siblings
        $userdupe = [];
        foreach ($allSiblings as $index => $t) {
            if (isset($userdupe[$t["id"]])) {
                unset($allSiblings[$index]);
                continue;
            }
            $userdupe[$t["id"]] = true;
        }

        $children = Person::where('father_id', $person->id)->orWhere('mother_id', $person->id)->orderBy('child_number')->get();

        $spouse = PersonHelper::spouse($person->gender);

        $partners = Partner::where($spouse->me_key, $person->id)->get();

        return view('content.bfr-person-show', compact('contentTitle', 'person', 'allSiblings', 'children', 'spouse', 'partners'));
    }

    public function edit($id)
    {
        $contentTitle = 'Orang';
        $educations = PersonHelper::listEducations();
        $maritalStatus = PersonHelper::listMaritalStatus();
        $person = Person::find($id);
        return view('content.bfr-person-edit', compact('contentTitle', 'educations', 'maritalStatus', 'person'));
    }

    public function familyTree($id)
    {
        $contentTitle = 'Orang';
        $person = Person::find($id);
        $spouse = PersonHelper::spouse($person->gender);
        return view('content.bfr-person-family-tree', compact('contentTitle', 'person', 'spouse'));
    }

    public function familyTreeJson($id)
    {
        $person = Person::find($id);
        if ($person->father_id) {
            $father = [
                'name' => $person->father->substr,
                'class' => $person->father->gender,
                'extra' => [
                    'id' => $person->father->id,
                    'tree_link' => route('person.family.tree', ['id' => $person->father->id])
                ],
                'marriages' => [
                    [
                        'spouse' => null,
                        'children' => null
                    ]
                ],
            ];
        } else {
            $father = [
                'name' => '...',
                'class' => 'man',
                'marriages' => [
                    [
                        'spouse' => null,
                        'children' => null
                    ]
                ],
            ];
        }
        if ($person->mother_id) {
            $father['marriages'][0]['spouse'] = [
                'name' => $person->mother->substr,
                'class' => $person->mother->gender,
                'extra' => [
                    'id' => $person->mother->id,
                    'tree_link' => route('person.family.tree', ['id' => $person->mother->id])
                ],
            ];
        } else {
            $father['marriages'][0]['spouse'] = [
                'name' => '...',
                'class' => 'woman',
            ];
        }
        if ($person->father_id && $person->mother_id) {
            $broSis = Person::where('father_id', $person->father_id)->where('mother_id', $person->mother_id)->orderBy('child_number')->get();
        } else {
            $broSis = [];
        }
        $broSisArray = [];

        $spouse = PersonHelper::spouse($person->gender);

        // Get data anak
        $marriagesPerson = Partner::where($spouse->me_key, $person->id)->get();

        $marriagesPersonArray = [];
        foreach ($marriagesPerson as $mp) {
            $marriagesPersonArray[$mp->{$spouse->key}]['spouse'] = [
                'name' => $mp->{$spouse->code}->substr,
                'class' => $mp->{$spouse->code}->gender,
                'extra' => [
                    'id' => $mp->{$spouse->code}->id,
                    'tree_link' => route('person.family.tree', ['id' => $mp->{$spouse->code}->id])
                ]
            ];
        }

        $children = Person::where($spouse->child_key, $person->id)->orderBy('child_number')->get();

        foreach ($children as $child) {
            $marriagesPersonArray[$child->{$spouse->parent_key}]['children'][] = [
                'name' => $child->substr,
                'class' => $child->gender,
                'extra' => [
                    'id' => $child->id,
                    'tree_link' => route('person.family.tree', ['id' => $child->id])
                ],
            ];
        }
        $marriagesPersonArray = array_values($marriagesPersonArray);

        foreach ($broSis as $br) {

            $broSisArray[] = [
                'name' => $br->substr,
                'class' => $br->gender,
                'textClass' => $br->id == $person->id ? 'font-weight-bolder' : '',
                'marriages' => $br->id == $person->id ? $marriagesPersonArray : null,
                'extra' => [
                    'id' => $br->id,
                    'tree_link' => route('person.family.tree', ['id' => $br->id])
                ],
            ];
        }
        if (empty($broSis)) {
            $broSisArray[] = [
                'name' => $person->substr,
                'class' => $person->gender,
                'textClass' => 'font-weight-bolder',
                'marriages' => $marriagesPersonArray,
                'extra' => [
                    'id' => $person->id,
                    'tree_link' => route('person.family.tree', ['id' => $person->id])
                ],
            ];
        }

        $father['marriages'][0]['children'] = $broSisArray;
        $json = [$father];
        return response()->json($json);
    }

    public function create()
    {
        $contentTitle = 'Orang';
        $educations = PersonHelper::listEducations();
        $maritalStatus = PersonHelper::listMaritalStatus();
        return view('content.bfr-person-create', compact('contentTitle', 'educations', 'maritalStatus'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nickname' => 'string|max:255|nullable',
                'education' => ['string', 'nullable', Rule::in(PersonHelper::listEducations())],
                'email' => 'email|nullable',
                'phone' => 'numeric|digits_between:10,15|nullable',
                'address' => 'string|nullable',
                'province' => 'string|nullable',
                'city' => 'string|nullable',
                'district' => 'string|nullable',
                'village' => 'string|nullable',
                'gender' => ['string', 'nullable', Rule::in(['man', 'woman'])],
                'identification_number' => 'numeric|digits_between:0,16|nullable',
                'child_number' => 'numeric|max:30|min:1|nullable',
                'birth_place' => 'string|nullable',
                'birth_date' => 'date|nullable',
                'life_status' => ['string', 'nullable', Rule::in(['alive', 'dead'])],
                'marital_status' => ['string', 'nullable', Rule::in(PersonHelper::listMaritalStatus())],
                'father_id' => ['nullable', Rule::in(Person::where('gender', 'man')->pluck('id')->toArray())],
                'mother_id' => ['nullable', Rule::in(Person::where('gender', 'woman')->pluck('id')->toArray())],
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }

            $person = [
                'name' => $request->name,
                'nickname' => $request->nickname,
                'education' => $request->education,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
                'village' => $request->village,
                'gender' => $request->gender,
                'identification_number' => $request->identification_number,
                'child_number' => $request->child_number,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'life_status' => $request->life_status == 'alive' ? 'alive' : 'dead',
                'dead_date' => $request->life_status == 'alive' ? null : $request->dead_date,
                'marital_status' => $request->marital_status,
                'father_id' => $request->father_id,
                'mother_id' => $request->mother_id,
            ];

            Person::create($person);

            DB::commit();
            return redirect()->route('person.index')->with('message', 'Data Orang berhasil dibuat');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nickname' => 'string|max:255|nullable',
                'education' => ['string', 'nullable', Rule::in(PersonHelper::listEducations())],
                'email' => 'email|nullable',
                'phone' => 'numeric|digits_between:10,15|nullable',
                'address' => 'string|nullable',
                'province' => 'string|nullable',
                'city' => 'string|nullable',
                'district' => 'string|nullable',
                'village' => 'string|nullable',
                'gender' => ['string', 'nullable', Rule::in(['man', 'woman'])],
                'identification_number' => 'numeric|digits_between:0,16|nullable',
                'child_number' => 'numeric|max:30|min:1|nullable',
                'birth_place' => 'string|nullable',
                'birth_date' => 'date|nullable',
                'life_status' => ['string', 'nullable', Rule::in(['alive', 'dead'])],
                'marital_status' => ['string', 'nullable', Rule::in(PersonHelper::listMaritalStatus())],
                'father_id' => ['nullable', Rule::in(Person::where('gender', 'man')->pluck('id')->toArray())],
                'mother_id' => ['nullable', Rule::in(Person::where('gender', 'woman')->pluck('id')->toArray())],
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }

            $person = Person::find($id);

            $person->name = $request->name;
            $person->nickname = $request->nickname;
            $person->education = $request->education;
            $person->email = $request->email;
            $person->phone = $request->phone;
            $person->address = $request->address;
            $person->province = $request->province;
            $person->city = $request->city;
            $person->district = $request->district;
            $person->village = $request->village;
            $person->gender = $request->gender;
            $person->identification_number = $request->identification_number;
            $person->child_number = $request->child_number;
            $person->birth_place = $request->birth_place;
            $person->birth_date = $request->birth_date;
            $person->life_status = $request->life_status == 'alive' ? 'alive' : 'dead';
            $person->dead_date = $request->life_status == 'alive' ? null : $request->dead_date;
            $person->marital_status = $request->marital_status;
            $person->father_id = $request->father_id;
            $person->mother_id = $request->mother_id;
            $person->save();

            DB::commit();
            return redirect()->route('person.index')->with('message', 'Data Orang berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }

    public function searchList(Request $request)
    {
        session()->put('search', $request->search);
        return redirect()->route('person.index');
    }

    public function search(Request $request)
    {
        $term = $request->input('term', '');
        if (strlen($term) < 3) {
            return response()->json([]);
        }
        $people = Person::where('name', 'LIKE', "%$term%")
            ->when($request->input('gender'), function ($query) use ($request) {
                $query->where('gender', '=', $request->input('gender'));
            })
            ->get(['id', DB::raw("concat(name, ' - ', IF(life_status = 'alive', '" . __('general.alive') . "', '" . __('general.dead') . "') ) as text")]);
        return response()->json(['results' => $people]);
    }
}
