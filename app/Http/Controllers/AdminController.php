<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Collective\Html\FormFacade;
use Route;
use Response;
use App\Category;
use App\Article;
use App\Comment;
use App\User;
use Auth;

class AdminController extends Controller
{
	protected $Categories;
	protected $Categories_select;
	protected $SubCategories_select;
	protected $Articles;
	protected $Comments;
	protected $Path;
	protected $User = NULL;
	
	function __construct(Request $request){
		$this->User = Auth::user();
		$this->Path = $request->path();		
		$this->Categories = Category::orderBy('name', 'asc')->get();
		$this->Categories_select = ['0' => 'Родительская категория'];
		
		foreach ($this->Categories as $Category){
			if($Category->parent == 0){	$this->Categories_select[$Category->id] = $Category->name;	}
			}
			
		foreach ($this->Categories as $Category){
			if($Category->parent != 0){ //children only
				$SubCategory_path = $Category->name; 
				foreach ($this->Categories as $Parent){
					if($Parent->id == $Category->parent){ $SubCategory_path = $Parent->name.' -> '.$SubCategory_path; }
					}
				$this->SubCategories_select[$Category->id] = $SubCategory_path;
				}
			}
		asort($this->SubCategories_select);	
	}
	
    public function index(){		
		
		return view('admin.index', ['categories' => $this->Categories, 'Categories_select' => $this->Categories_select, 'path' => $this->Path, 'user' => $this->User]); 
	}
	
	public function categories(){
		return view('admin.categories', ['categories' => $this->Categories, 'Categories_select' => $this->Categories_select, 'path' => $this->Path]); 
		}
	
	public function create_category(Request $request){
		$name = $request->input('name');
		$parent = $request->input('parent');
		$category = new Category;
		$category->name = $name;
		$category->parent = $parent;
		$category->save();
		return redirect('adminzone/categories');
	}
		
	public function create_article(Request $request){
		$title = $request->input('title');
		$category = $request->input('category');					
		$content = $request->input('content');					
		$intro = $request->input('intro');					
		$status = $request->input('status');				
		
		$article = new Article;
		$article->title = $title;
		$article->category_id = $category;
		$article->content = addslashes($content);
		$article->intro = $intro;
		$article->status = $status;
		$article->save();
		
		return redirect('adminzone/articles');
	}

	public function update_article(Request $request){
		$title = $request->input('title');
		$category = $request->input('category');					
		$content = $request->input('content');					
		$intro = $request->input('intro');				
		$status = $request->input('status');				
		$id = $request->input('id');				
		
		Article::where('id', $id)
			->update(['title' => $title, 
					'category_id' => $category,
					'intro' => $intro,
					'content' => $content,
					'status' => $status]);
		
		return redirect('adminzone/articles');
	}
	
	public function update_category(Request $request){
		$name = $request->input('up_name');
		$parent = $request->input('up_parent');		
		$categoty_id = $request->input('up_categoty_id');		
            
		Category::where('id', $categoty_id)->update(['name' => $name, 'parent' => $parent]);				
		return redirect('adminzone/categories');
	}
	
	public function delete_category(Request $request){
		$categoty_id = $request->input('categoty_id');
		Category::where('id', '=', $categoty_id)->delete();
		return redirect('adminzone/categories');
	}

	public function delete_article(Request $request){
		$article_id = $request->input('article_id');
		Article::where('id', '=', $article_id)->delete();
		return redirect('adminzone/articles');
	}
	
	public function change_article_status(Request $request){
		$article_id = $request->input('article_id');
		$article_status = $request->input('article_status');
		$myresult = "epta!";
		
		if($article_status == 0){
			$myresult = "1";
		}elseif($article_status == 1){
			$myresult = "0";
		}		
		Article::where('id', '=', $article_id)->update(['status' => $myresult]);
		
		return redirect('adminzone/articles');
	}

	public function get_subcategories(Request $request){
		$categoty_id = $request->input('id');
		$subcategories = Category::where('parent', '=',$categoty_id)->orderBy('name', 'asc')->get();
		return Response::json(['subcategories'=>$subcategories]);
	}
	
	public function articles(){
		$this->Articles = Article::join('categories', 'articles.category_id', '=', 'categories.id')
			->select('articles.id', 'articles.title', 'categories.name as category', 'articles.status', 'articles.created_at', 'articles.updated_at')
			->paginate(10);
		return view('admin.articles', ['articles' => $this->Articles, 'Categories_select' => $this->SubCategories_select, 'path' => $this->Path]); 
	}
	
	public function article(){
		$path_arr = explode("/", $this->Path);
		if(count($path_arr) >= 3){
			$id = $path_arr[2];
			$CurArticle = Article::findOrFail($id);
		}
		if(isset($CurArticle) && !is_null($CurArticle)){
			return view('admin.article', ['Categories_select' => $this->SubCategories_select, 'path' => $this->Path, 'CurArticle' => $CurArticle]); 
		}else{
			return view('admin.article', ['Categories_select' => $this->SubCategories_select, 'path' => $this->Path]); 
		}	
	}
	
	public function comments(){
		$this->Comments = Comment::orderBy('created_at', 'desc')->paginate(10);
		return view('admin.comments', ['comments' => $this->Comments, 'path' => $this->Path]); 
	}
	
	public function block_user(Request $request){
		$user_id = $request->input('user_id');
		$redirectPath = $request->input('redirectPath');
		$task = $request->input('task');
		
		$user = User::find($user_id);
		
		if($user){
			if($task == 'block'){
				$user->block = 1;
			}elseif($task == 'unblock'){
				$user->block = 0;
			}
		$user->save();
		}
		return redirect($redirectPath);
	}
	
	public function users(){
		$users = User::orderBy('name')->paginate(10);
		return view('admin.users', ['path' => $this->Path, 'users' => $users]); 
	}

	public function set_user_role(Request $request){
		$user_id = $request->input('user_id');
		$user_role = $request->input('user_role');
		$redirectPath = $request->input('redirectPath');
		
		$user = User::find($user_id);
		if($user){
			$user->role = $user_role;
			$user->save();
		}
		return redirect($redirectPath);
	}
}
