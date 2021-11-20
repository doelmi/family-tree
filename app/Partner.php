<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'husband_id',
        'wife_id',
        'marriage_date',
        'marriage_status',
    ];

    public function husband()
    {
        return $this->hasOne('App\Person', 'id', 'husband_id');
    }

    public function wife()
    {
        return $this->hasOne('App\Person', 'id', 'wife_id');
    }

    protected $casts = [
        'marriage_date' => 'date',
    ];
}
