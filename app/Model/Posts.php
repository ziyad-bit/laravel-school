<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table='posts';
    protected $fillable = [
        'post','photo','admin_id','level_id','fixed','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('post','photo','created_at','id','admin_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comments','post_id');
    }

    public function admins()
    {
        return $this->belongsTo('App\Model\Admins','admin_id');
    }
}
