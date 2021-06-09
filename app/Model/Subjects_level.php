<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Subjects_level extends Model
{
    protected $table='subjects_level';
    protected $fillable = [
        'subject_id','level_id','updated_at','created_at',
    ];

   
}
