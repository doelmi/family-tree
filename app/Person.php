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
        'nickname',
        'photo',
        'education',
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
        'dead_date',
        'child_number',
    ];

    public function father()
    {
        return $this->hasOne('App\Person', 'id', 'father_id');
    }

    public function mother()
    {
        return $this->hasOne('App\Person', 'id', 'mother_id');
    }

    public function daughters($parent_key)
    {
        return $this->hasMany('App\Person', $parent_key, 'id')->where('gender', 'woman');
    }

    public function sons($parent_key)
    {
        return $this->hasMany('App\Person', $parent_key, 'id')->where('gender', 'man');
    }

    public function children($parent_key)
    {
        return $this->hasMany('App\Person', $parent_key, 'id');
    }

    protected $casts = [
        'birth_date' => 'date',
        'dead_date' => 'date',
    ];

    protected $appends = ['substr'];

    public function getSubstrAttribute()
    {
        $value = utf8_encode($this->name);
        $strlen = strlen($value);
        $string = $strlen > 25 ? substr($value, 0, 25) . "..." : $value;
        return strtoupper($string);
    }
}
