<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // mass assignment
    protected $fillable=[
      'category_id',
        'photo_id',
        'title',
        'body'
    ];

    /*
     * realtion with user model
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /*
     * relation with photo model
     */
    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    /*
     * relation with catagory model
     */
    public function category(){
        return $this->belongsTo('App\Category');
    }

    /*
     * post relationship with comment
     */
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    /*
     * function for placeholder image
     */
    public function photoPlaceholder(){
        return "http://placehol.it/200x700";
    }
}
