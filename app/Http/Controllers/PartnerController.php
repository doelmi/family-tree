<?php

namespace App\Http\Controllers;

use App\Helpers\PersonHelper;
use App\Partner;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PartnerController extends Controller
{
    public function create(Request $request)
    {
        $contentTitle = 'Relasi Pasangan';
        $husband_id =  old('husband_id') ?? ($request->input('husband_id') ?? null);
        $wife_id = old('wife_id') ?? ($request->input('wife_id') ?? null);
        $husband = $husband_id ? $husband = Person::find($husband_id) : null;
        $wife = $wife_id ? $wife = Person::find($wife_id) : null;
        return view('content.bfr-partner-create', compact('contentTitle', 'husband', 'wife'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'marriage_date' => 'date|nullable',
                'wife_id' => ['required', Rule::in(PersonHelper::allowedWife())],
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }

            $partner = [
                'marriage_date' => $request->marriage_date,
                'husband_id' => $request->husband_id,
                'wife_id' => $request->wife_id,
            ];

            Partner::create($partner);

            DB::commit();
            return ($request->referrer ? redirect($request->referrer) : redirect()->route('person.show', ['id' => $request->husband_id]))->with('message', 'Relasi Pasangan berhasil dibuat');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $contentTitle = 'Relasi Pasangan';
        $partner = Partner::find($id);
        $husband = $partner->husband;
        $wife = $partner->wife;
        return view('content.bfr-partner-edit', compact('contentTitle', 'husband', 'wife', 'partner'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'marriage_date' => 'date|nullable',
                'wife_id' => ['required', Rule::in(PersonHelper::allowedWife((int) $request->wife_id))],
            ]);

            if ($validator->fails()) {
                throw new \Exception(implode(" ", $validator->messages()->all()));
            }

            $partner = Partner::find($id);
            $partner->marriage_date = $request->marriage_date;
            $partner->husband_id = $request->husband_id;
            $partner->wife_id = $request->wife_id;
            $partner->save();

            DB::commit();
            return ($request->referrer ? redirect($request->referrer) : redirect()->route('person.show', ['id' => $request->husband_id]))->with('message', 'Relasi Pasangan berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['error' => $th->getMessage()])->withInput();
        }
    }
}
