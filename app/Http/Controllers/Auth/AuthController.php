<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use Auth;
use Illuminate\Http\Request;
//use Validator;
use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
	protected $redirectPath = '/';
    
    function __construct(Request $request){
		//$this->redirectPath = $request->path();
	}
	
    public function redirectToProvider(Request $request, $provider){
		switch ($provider){
			case "facebook":
				return Socialite::driver('facebook')->redirect();
			break;
			case "vkontakte":
				return Socialite::with('vkontakte')->redirect();
			break;
			}
    }
    
     public function handleProviderCallback(Request $request, $provider){	 
        try {
			switch ($provider){
			case "facebook":
				$facebookUser = Socialite::driver('facebook')->user();
				$authUser = User::where('facebook_id', $facebookUser->user['id'])->first();
			break;
			case "vk":
				$vkUser = Socialite::with('vkontakte')->user();
				$authUser = User::where('vkontakte_id', $vkUser->user['uid'])->first();
			break;
			}            
        } catch (Exception $e) {
            return redirect('auth/'.$provider);
        }
        
        if ($authUser === NULL){	
			switch ($provider){
			case "facebook":
				User::create([
				'name' => $facebookUser->user['name'],
				'email' => $facebookUser->user['email'],
				'facebook_id' => $facebookUser->user['id'],
				'role' => "user",
				'gender' => $facebookUser->user['gender'],
				'avatar' => $facebookUser->avatar
				]);
				$authUser = User::where('facebook_id', $facebookUser->user['id'])->first();
			break;
			case "vk":			
				User::create([
				'name' => $vkUser->user['first_name'].' '.$vkUser->user['last_name'],
				'email' => $vkUser->user['email'],
				'vkontakte_id' => $vkUser->user['uid'],
				'role' => "user",
				'avatar' => $vkUser->user['photo']
				]);
				$authUser = User::where('vkontakte_id', $vkUser->user['uid'])->first();			
			break;
			}
		}			
        Auth::login($authUser, true);
        return redirect()->back();
    }
     
	/*
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    */
}
