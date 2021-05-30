<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Degrees extends Model
{
    protected $table='degrees';
    protected $fillable = [
        'degrees','exam_id','user_id','finish','page','updated_at','created_at',
    ];
}
