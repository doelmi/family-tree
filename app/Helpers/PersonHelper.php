<?php

namespace App\Helpers;

use App\Partner;
use App\Person;

class PersonHelper
{
    public static function listEducations()
    {
        return [
            'tk',
            'sd',
            'smp',
            'sma',
            'd3',
            'd4-s1',
            's2',
            's3',
        ];
    }

    public static function listMaritalStatus()
    {
        return [
            'single',
            'married',
            'widowed',
            'divorced',
            'separated',
        ];
    }

    public static function allowedHusband()
    {
        $request = request();
        $person = Person::find($request->wife_id);
        $daughterId = $person->daughters->pluck('id')->toArray();
        $partnersId = Partner::whereIn('wife_id', $daughterId)->orWhere('wife_id', $request->wife_id)->pluck('husband_id')->toArray();

        return Person::where('gender', 'man')->where(function ($query) use ($request) {
            $query->where('mother_id', '!=', $request->wife_id);
            $query->orWhere('mother_id', null);
        })->where(function ($query) use ($person) {
            $query->where('father_id', '!=', $person->father_id);
            $query->orWhere('father_id', null);
        })->where('id', '!=', $person->father_id)
        ->whereNotIn('id', $partnersId)
        ->pluck('id')->toArray();
    }
}
