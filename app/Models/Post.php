<?php

namespace App\Models;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Specify the associated table
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    //Defines the relationship between post and the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //get all the comments from the post
    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}


