<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a new comment or reply
    public function store(Request $request){
        $request->validate([
            'post_id'=>'required|exists:posts,id',
            'content'=>'required|string',
            'parent_id'=>'nullable|exists:comments,id'
        ]);

    /*limit the nested comment to 2 levels
    if ($request->parent_id) {
        $parent = Comment::find($request->parent_id);

        // Check if the parent exists and is already a reply
        if ($parent && $parent->parent_id) {
            return response()->json([
                'error' => 'Cant reply more than 2 levels'
            ], 422);
        }
    }*/

    // Check if the comment is a reply to another comment
    if ($request->filled('parent_id')) {
    $parent = Comment::find($request->parent_id);

    if (!$parent) {
        return response()->json([
            'error' => 'Parent comment not found.'
        ], 404);
    }

    // Check if the parent is already a reply (i.e., 2nd level)
    if (!is_null($parent->parent_id)) {
        return response()->json([
            'error' => 'Cant reply more than 2 levels'
        ], 422);
    }
}

    // Create and store the comment
    $comment = Comment::create([
        'user_id'=>auth('api')->id(),
        'post_id'=>$request->post_id,
        'content'=>$request->content,
        'parent_id'=>$request->parent_id
    ]);

    return response()->json($comment,201);
}}