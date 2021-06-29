<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Posts extends Model
{
    use SearchableTrait;

    protected $searchable=[
        'columns'=>[
            'posts.subject' => 10,
            'posts.post'    => 9,
        ],
    ];

    protected $table='posts';
    protected $fillable = [
        'post','photo','admin_id','level_id','subject','fixed','updated_at','created_at','file','video'
    ];

    public function scopeSelection($q)
    {
        return $q->select('post','photo','created_at','id'
                        ,'admin_id','level_id','file','video','subject');
    }

    public function scopeGroup($q)
    {
        return $q->groupBy(['id','post','photo'
        ,'admin_id','level_id','subject','fixed','updated_at','created_at','file','video']);
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
