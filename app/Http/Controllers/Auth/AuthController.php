<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Auth;
use DB;
use Facebook\Facebook; 

class AuthController extends Controller
{
    public function redirectToFacebook()
	{
	    return Socialite::driver('facebook')->redirect();
	}
	public function handleFacebookCallback()
	{
	    $user = Socialite::driver('facebook')->user();
	    $checkUser = $this->checkEmail($user->email);
	    if ($checkUser) {
	    	Auth::login($checkUser);
	    	return redirect('home');
	    }else{
	    	$createdUser = User::Create([
		        'name'     => $user->name,
		        'email'    => $user->email,
		        'password' => bcrypt('abcde'),
		        'avatar'   => $user->avatar,
		        'remember_token' => $user->token
			 ]);
	    	Auth::login($createdUser);
		 		return redirect('home');
	    }
	}

	public function getListFriends()
	{
		$ch  = curl_init(); 
 		$url = "https://graph.facebook.com/v2.11/";
 		$uri = "me/taggable_friends?access_token=" .env('TOKEN_FB');
        // set url 
        $url = $url . $uri;
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $output = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
        $output = json_decode($output);
        // die(var_dump($output->data[0]->picture->data->url));
        // dd($output);
        return view('friendlists', compact("output"));
	}
	public function checkEmail($email)
	{
		$user = User::where('email','=',$email)->first();
		return $user;
	}
	public function addNewFeed()
	{
		return view('addnewfeed');
	}
	public function postNewFeed(Request $request)
	{
		$message = $request->input('message');
		// dd($message);
		$fb = new Facebook();
		$response = $fb->post(
		    '/me/feed',
		    array (
		      'message' => $message,
		    ),
		    env('TOKEN_FB')
		);
		return redirect('home');
	}

}
