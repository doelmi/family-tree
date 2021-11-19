<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'user_id', 'people_id', 'role_id', 'status'
    ];

    public function role()
    {
        return $this->hasOne('App\UserRole', 'id', 'role_id');
    }

    public function person()
    {
        return $this->hasOne('App\Person', 'id', 'people_id');
    }
}
