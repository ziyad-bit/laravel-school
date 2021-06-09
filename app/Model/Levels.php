<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    protected $table='levels';
    protected $fillable = [
        'name', 'school','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('id','name');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Model\Subjects','subjects_level','level_id','subject_id');
    }
}
