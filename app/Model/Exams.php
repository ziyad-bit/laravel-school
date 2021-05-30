<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $table='exams';
    protected $fillable = [
        'name', 'duration','active','level_id', 'term'
        ,'token','number_of_questions','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('number_of_questions','name','id','level_id','term','created_at');
    }

    public function scopeUserSelection($q)
    {
        return $q->select('number_of_questions','name','id','token','created_at');
    }

    public function questions()
    {
        return $this->hasMany('App\Model\Questions','exam_id');
    }

}
