<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiResponseTrait;

class PostController extends Controller
{
    use  ApiResponseTrait;
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }
    
    public function index()
    {
        $posts=Post::all();
        if($posts->isEmpty()){
            return $this->notFound('not found any post');
        }else{
            $posts=PostResource::collection($posts);
            return $this->successResponse('this is all posts',$posts,200);
           
        }
    }
 
 
    public function store(PostRequest $request)
    {
        
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return $this->Unauthorized('Unauthorized user');
        }
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->category_id=$request->category_id;
        $post->user_id = $user->id;
        $post->save();
        // $post=PostResource::collection($post);
        return $this->successResponse('successefuly add a new post',$post,201);
    }

 
    public function update(PostRequest $request, Post $post)
    {
        $post->title=$request->title??$post->title;
        $post->body=$request->body??$post->body;
        $post->category_id=$request->category_id??$post->category_id;
        $post->save();
       // $post=PostResource::collection($post);
         return $this->successResponse('successefuly edit a post',$post,200);
    }

    
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->successResponse('successefully deleted',200);
    }
}
