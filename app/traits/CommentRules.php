<?php

namespace App\Traits;

trait CommentRules{
    public function commentRules()
    {
        return [
            'comment'=>'required|max:3'
        ];
    }

    public function commentMessages()
    {
        return [
            'required' => 'this field is required',
            'max'      => 'you should enter less than 300 characters'
        ];
    }
}
