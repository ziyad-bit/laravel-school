<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Degrees extends Model
{
    protected $table='degrees';
    protected $fillable = [
        'degrees','exam_id','user_id','subject_id','finish','page','updated_at','created_at',
    ];

    public function exams()
    {
        return $this->hasMany('App\Model\Exams','exam_id');
    }

    public function subjects()
    {
        return $this->belongsTo('App\Model\Subjects','subject_id');
    }
}
