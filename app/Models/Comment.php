<?php

namespace App\Models;
use App\Models\User;
use App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Specify the associated table
    protected $table = 'comments';
    protected $fillable = [
        'content',
        'post_id',
        'user_id'
    ];

    // Define the relationship to the User model
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Post model
    public function post(){
        return $this->belongsTo(Post::class);
    }

    // Define the relationship to the Post model
    public function replies(){
        return $this->hasMany(\App\Models\Comment::class, 'parent_id')->with('replies');
    }

}
