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
        $husband_id = $request->input('husband_id') ?? (old('husband_id') ?? null);
        $wife_id = $request->input('wife_id') ?? (old('wife_id') ?? null);
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
                'husband_id' => ['required', Rule::in(PersonHelper::allowedHusband())],
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
}
