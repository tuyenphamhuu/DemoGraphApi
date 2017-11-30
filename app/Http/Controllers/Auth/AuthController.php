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
	    } else {
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
 		$uri = "me/friends?fields=picture,name,gender&limit=200&access_token=" .env('TOKEN_FACE');
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
        // dd($output);
        // die(var_dump($output->data[0]->picture->data->url));
        // dd($output->data);
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
		$link = $request->input('link');
		// dd($message);
		$fb = new Facebook();
		$response = $fb->post(
		    '/me/feed',
		    array (
		      'message' => $message,
		      'link'    => $link
		    ),
		    env('TOKEN_FB')
		);
		return redirect('home');
	}

	public function oneNewFeed($id)
	{
		// // $idnf = $id;
		// $fb = new Facebook();
		// $response = $fb->get(
		// 	// '/'.$idnf.'/feed',	
		// 	'/ngoc.vit.923/feed?limit=1',
		// 	env('TOKEN_FACE')
		// );
		// dd($response);
		$idn = $id;
		$ch  = curl_init(); 
 		$url = "https://graph.facebook.com/v2.11/";
 		$uri = $idn."/feed?limit=1&access_token=" .env('TOKEN_FACE');
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
        // dd($output->data[0]->id);
        // return $output->data[0]->id;
        return $output->data;
	}

	public function like($id)
	{
		$idnew = $this->oneNewFeed($id);
		// dd($idnew);
		// $fb = new Facebook();
		// $response = $fb->post(
		//     $idnew.'/reactions',
		//     array (
		//       'type' => 'LOVE',
		//     ),
		//     env('TOKEN_FB')
		// );
		// dd($response);
		// return redirect('home');
		$ch  = curl_init(); 
		foreach ($idnew as $value) {
	 		$url = "https://graph.facebook.com/v2.11/";
	 		$uri = $value->id."/reactions?type=LOVE&method=POST&access_token=" .env('TOKEN_FACE');
	        // set url 
	        $url = $url . $uri;
	        curl_setopt($ch, CURLOPT_URL, $url); 
	        //return the transfer as a string 
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	        // $output contains the output string 
	        $output = curl_exec($ch); 
	        // close curl resource to free up system resources 
		}
	    curl_close($ch);
		
        return redirect('home');
	}

}
