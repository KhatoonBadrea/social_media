<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    use  ApiResponseTrait;
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
     
        $comments=Comment::all();
        
        
        if($comments->isEmpty()){
          return $this->notFound('not found any comment');
      }else{
        $comments=CommentResource::collection($comments);
          return $this->successResponse('this is all comments',$comments,200);
         
      }
    }

    
    public function store(Request $request,$postId)
    {
       
        $post = Post::find($postId);
        if (!$post) {
            return $this->notFound('post no found');
        }

        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return $this->Unauthorized('Unauthorized user');
        }

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $user->id;
        $comment->post_id = $postId;
        $comment->save();
        
        return$this->successResponse('successefuly add a comment',$comment,201);
    }
    
  
    



  
    public function update(CommentRequest $request, Comment $comment)
    {
     $comment->comment=$request->comment??$comment->comment;
     $comment->save();
    //  $comment=CommentResource::collection($comment);
      return $this->successResponse('successefuly edit a comment',$comment,200);
    }

    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
        return $this->successResponse('successefully deleted',200);
    }
}
