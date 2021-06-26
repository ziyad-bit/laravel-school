<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table='comments';
    protected $fillable = [
        'comment','post_id','user_id','admin_id','updated_at','created_at',
    ];

    public function scopeSelection($q)
    {
        return $q->select('comment','created_at','user_id','admin_id','post_id','id');
    }

    public function posts()
    {
        return $this->belongsTo('App\Model\Posts','post_id');
    }

    public function admins()
    {
        return $this->belongsTo('App\Model\Admins','admin_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
