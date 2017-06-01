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
        return $this->belongsTo('App\Catagory');
    }
}
