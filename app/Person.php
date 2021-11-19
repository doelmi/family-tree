<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'province',
        'city',
        'district',
        'village',
        'gender',
        'identification_number',
        'birth_place',
        'birth_date',
        'life_status',
        'marital_status',
        'father_id',
        'mother_id',
    ];
}
