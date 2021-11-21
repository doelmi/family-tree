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

    public static function spouse($gender)
    {
        return (object) [
            'name' => $gender == 'man' ? 'Istri' : 'Suami',
            'code' => $gender == 'man' ? 'wife' : 'husband',
            'key' => $gender == 'man' ? 'wife_id' : 'husband_id',
            'parent' => $gender == 'man' ? 'mother' : 'father',
            'parent_key' => $gender == 'man' ? 'mother_id' : 'father_id',
            'me' => $gender == 'man' ? 'Suami' : 'Istri',
            'me_key' => $gender == 'man' ? 'husband_id' : 'wife_id',
            'child' => $gender == 'man' ? 'father' : 'mother',
            'child_key' => $gender == 'man' ? 'father_id' : 'mother_id',
        ];
    }

    // public static function allowedHusband()
    // {
    //     $request = request();
    //     $person = Person::find($request->wife_id);
    //     $daughterId = $person->daughters('mother_id')->pluck('id')->toArray();
    //     $partnersId = Partner::whereIn('wife_id', $daughterId)->orWhere('wife_id', $request->wife_id)->pluck('husband_id')->toArray();

    //     $grandfathers = Person::whereIn('id', [@$person->mother->father_id, @$person->father->father_id])->pluck('id')->toArray();
    //     $uncles = Person::where('gender', 'man')->where(function ($query) use ($person) {
    //         $query->whereIn('father_id', [@$person->mother->father_id, @$person->father->father_id]);
    //         $query->orWhereIn('mother_id', [@$person->mother->mother_id, @$person->father->mother_id]);
    //     })->pluck('id')->toArray();

    //     return Person::where('gender', 'man')->where(function ($query) use ($request) {
    //         $query->where('mother_id', '!=', $request->wife_id);
    //         $query->orWhere('mother_id', null);
    //     })->where(function ($query) use ($person) {
    //         $query->where('father_id', '!=', $person->father_id);
    //         $query->orWhere('father_id', null);
    //     })->where('id', '!=', $person->father_id)
    //     ->whereNotIn('id', array_merge($partnersId, $grandfathers, $uncles) )
    //     ->pluck('id')->toArray();
    // }

    public static function allowedWife()
    {
        $request = request();
        $person = Person::find($request->husband_id);

        //Mencari data Menantu perempuan dari anak laki-laki
        $sonsId = $person->sons('father_id')->pluck('id')->toArray();
        $partnersId = Partner::whereIn('husband_id', $sonsId)->orWhere('husband_id', $request->husband_id)->pluck('wife_id')->toArray();

        //Mencari data Nenek Baik dari ayah atau dari Ibu
        $grandmothers = Person::whereIn('id', [@$person->mother->mother_id, @$person->father->mother_id])->pluck('id')->toArray();

        // Mencari Data Bibi baik dari ayah maupun dari Ibu
        $aunts = Person::where('gender', 'woman')->where(function ($query) use ($person) {
            $query->whereIn('father_id', [@$person->mother->father_id, @$person->father->father_id]);
            $query->orWhereIn('mother_id', [@$person->mother->mother_id, @$person->father->mother_id]);
        })->pluck('id')->toArray();

        //Mencari data keponakan perempuan dari anak ayah atau Ibu
        $broSisF = $person->father ? $person->father->children('father_id')->pluck('id')->toArray() : [];
        $broSisM = $person->mother ? $person->mother->children('mother_id')->pluck('id')->toArray() : [];
        $broSis = array_unique(array_merge($broSisF, $broSisM));
        $nieces = Person::where('gender', 'woman')->where(function ($query) use ($broSis) {
            $query->whereIn('father_id', $broSis);
            $query->orWhereIn('mother_id', $broSis);
        })->pluck('id')->toArray();

        // Wanita yang boleh dinikahi
        return Person::where('gender', 'woman')->where(function ($query) use ($request) {
            $query->where('father_id', '!=', $request->husband_id);
            $query->orWhere('father_id', null);
        })->where(function ($query) use ($person) {
            $query->where('mother_id', '!=', $person->mother_id);
            $query->orWhere('mother_id', null);
        })->where('id', '!=', $person->mother_id)
        ->whereNotIn('id', array_merge($partnersId, $grandmothers, $aunts, $nieces) )
        ->pluck('id')->toArray();
    }
}
