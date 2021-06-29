<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    protected $table='admins';
    protected $fillable = [
        'name', 'email','photo', 'password','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('name','photo','id');
    }

    public function posts()
    {
        return $this->hasMany('App\Model\Posts','admin_id');
    }

    public function exams()
    {
        return $this->hasMany('App\Model\Exams','admin_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Model\Comments','admin_id');
    }
}
