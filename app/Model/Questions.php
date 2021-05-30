<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table='questions';
    protected $fillable = [
        'question', 'choice1', 'choice2','choice3','choice4','choice5','correct_ans','exam_id','updated_at','created_at',
    ];

    public function exams()
    {
        return $this->belongsTo('App\Model\Exams','exam_id');
    }
}
