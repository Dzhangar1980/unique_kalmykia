<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
{	
    public function create(Request $request){
		$content = $request->input('comment');
		$user_id = $request->input('user_id');
		$article_id = $request->input('article_id');
		$redirectPath = $request->input('redirectPath');
		$status = 1;
		
		$comment = new Comment;
		$comment->content = strip_tags($content);
		$comment->user_id = $user_id;
		$comment->article_id = $article_id;
		$comment->status = $status;
		$comment->save();
		
		return redirect($redirectPath);
	}
	
	public function delete(Request $request){
		$comment_id = $request->input('comment_id');
		$redirectPath = $request->input('redirectPath');
		$comment = Comment::find($comment_id);
		$comment->delete();
		return redirect($redirectPath);
	}

	public function approve(Request $request){
		$comment_id = $request->input('comment_id');
		$redirectPath = $request->input('redirectPath');
		$comment = Comment::find($comment_id);
		$comment->status = 1;
		$comment->save();
		return redirect($redirectPath);
	}
	
	public function delete_user_comments(Request $request){
		$user_id = $request->input('user_id');
		$redirectPath = $request->input('redirectPath');
		Comment::where('user_id', $user_id)->delete();
		return redirect($redirectPath);
	}
}
