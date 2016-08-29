<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Category;
use App\Article;
use DB;
use Route;
use Validator;
use Mail;

class ContentController extends Controller
{
	
	public function feedBack(Request $request){
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'email' => 'required|email',
			'userMessage' => 'required',
			]);
		
		if($validator->passes()){
			$userMessage = $this->clearComment($request->userMessage);
			if(trim($userMessage) != ''){
				
			/*
			Mail::raw('Text to e-mail', function ($message) {
				$message->from('support@uni08.ru');
				$message->to('foo@example.com');
				$message->subject('Feed back');
			});
			*/
			
				$flashMessage = '<p><b>Всё отлично!</b></p><p>Мы благодарны Вам за ваше письмо. Ответим Вам как можно скорее!</p>';
			}else{
				$flashMessage = '<p><b>Ой! Что-то не так....</b></p><p>Мы просим Вас более внимательно заполнять форму!</p>';
			}
		}else{
			$flashMessage = '<p><b>Ой! Что-то не так....</b></p><p>Мы просим Вас более внимательно заполнять форму!</p>';
		}
		return redirect()->back()->with('flashMessage', $flashMessage);;
	}
	
	public function showHomePage(){
		$Articles = Article::orderBy('created_at', 'desc')->limit(10)->get();
		return view('front.index', ['Articles' => $Articles]);
	}
		
    public function showCaterory($id){		
		if($id){
			$categoryIds = [$id];
			$Category = Category::find($id);
			if(!$Category){ return redirect('/'); }
			if($Category->parent == 0){
				foreach($Category->children as $children){
					$categoryIds[] = $children->id;
				}
			}
						
			$Articles = Article::with('category', 'comments')
                        ->whereIn('category_id', $categoryIds)
                        ->whereStatus(1)
                        ->orderBy('updated_at', 'desc')
                        ->paginate(10);
			
			return view('front.category', ['Category' => $Category, 'Articles' => $Articles]);

		}else{ 
			return redirect('/'); 
		}		
	}
	
	public function showArticle($id){
		if($id){
			$Article = Article::find($id);
			if(!$Article){ return redirect('/'); }
			$Article->hits = $Article->hits + 1;
			$Article->save();
			
			$Article = Article::where('id', $id)->first();
			$Comments = Article::find($id)->comments()->orderBy('created_at', 'desc')->get();
			
			return view('front.article', ['Article' => $Article, 
						'Category' => $Article->category, 'Comments' => $Comments]); 
		}else{
			return redirect('/');
		}
	}
	
	public static function clearComment($source){
		$withoutHTML = strip_tags($source);
		
		return $withoutHTML;		
	}
}
