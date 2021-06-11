<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Paypals extends Model
{
    protected $table='paypals';
    protected $fillable = [
        'degree_id','user_id','payment_id','updated_at','created_at',
    ];

}
