<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table='subjects';
    protected $fillable = [
        'name','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('name','id');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Model\Levels','subjects_level','subject_id','level_id');
    }

    public function degrees()
    {
        return $this->hasMany('App\Model\Degrees','subject_id');
    }
}
