<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=[
        'post_id',
        'author',
        'is_active',
        'email',
        'photo',
        'body'
    ];

    /*
     * comment has many replies
     */
    public function replies(){
        return $this->hasMany('App\CommentReply');
    }

    /*
     * comment belongs to post
     */
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
