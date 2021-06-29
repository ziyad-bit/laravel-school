<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $table='exams';
    protected $fillable = [
        'name', 'duration','active','level_id', 'admin_id', 'term'
        ,'token','number_of_questions','date','subject_id','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('number_of_questions','name','id','level_id'
                        ,'date','term','created_at');
    }

    public function scopeUserSelection($q)
    {
        return $q->select('number_of_questions','name','id','token','duration'
                        ,'created_at','updated_at','date', 'admin_id','subject_id');
    }

    public function scopeActive($q)
    {
        return $q->where('active',1);
    }

    public function questions()
    {
        return $this->hasMany('App\Model\Questions','exam_id');
    }

    public function admins()
    {
        return $this->belongsTo('App\Model\Admins','admin_id');
    }

    public function subjects()
    {
        return $this->belongsTo('App\Model\Subjects','subject_id');
    }

    public function degrees()
    {
        return $this->hasMany('App\Model\Degrees','exam_id');
    }

}
