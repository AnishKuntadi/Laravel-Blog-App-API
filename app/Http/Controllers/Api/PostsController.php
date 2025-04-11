<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class PostsController extends Controller
{
    public function index(){
        // Get posts along with comments, replies, and user info, paginated
        $posts = Post::with(['comments.replies', 'user'])->paginate(10);
        
        // Check if any posts are found
        if($posts->count() > 0){
            return PostResource::collection($posts);
        } else {
            return response()->json(['message' => "No Record Available"], 200);
        }
    }

    // Store a new post
    public function store(Request $request){
        // Validate incoming request data
        $validator = validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'content'=>'required'
        ]);

        //if fails generate the error message
        if($validator->fails()){
            return response()->json([
                'message'=>'All Fields are Mandatory',
                'error'=>$validator->messages()
            ],422);
        }

        // Create new post
        $post = Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id' => auth('api')->id()

        ]);

        // Return success response
        return response()->json([
            'message'=>'Posts created Successfully',
            'data'=>new PostResource($post)
        ],200);
    }

    // Show a single post
    public function show(Post $post){
        return new PostResource($post);
    }

     // Update a post
    public function update(Request $request, Post $post){
        $validator = validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'content'=>'required'   
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'All Fields are Mandatory',
                'error'=>$validator->messages()
            ],422);
        }

        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id' => auth('api')->id()
        ]);
        return response()->json([
            'message'=>'Posts Updated Successfully',
            'data'=>new PostResource($post)
        ],200);
    }

    // Delete a post
    public function destroy(Post $post){
        $post->delete();

        return response()->json([
            'message'=>"Post Deleted Successfully"
        ],200);
    }
}
