<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Auth;
use DB;
use Facebook\Facebook;
use App\Repositories\Contracts\UserInterface;
use Session;

class AuthController extends Controller
{
    protected $repository;

    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }

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
            $createdUser = $this->repository->addUser($user);
            Auth::login($createdUser);
            return redirect('home');
        }
    }

    public function getListFriends()
    {
        $ch  = curl_init();
        $url = "https://graph.facebook.com/v2.11/";
        $uri = "me/friends?fields=picture,name,gender&limit=200&access_token=" .Session::get('token');
        $output = $this->getCurl($ch, $url, $uri);
        curl_close($ch);
        $output = json_decode($output, true);
        // dd(var_dump($output['error']));
        if (!isset($output['error'])) {
            $output = collect($output['data']);
            return view('friendlists', compact("output"));
        } else {
            return redirect('home');
        }


    }

    public function checkEmail($email)
    {
        $user = User::where('email','=',$email)->first();
        return $user;
    }

    public function addNewFeed()
    {
        // dd(Session::get('token'));
        return view('addnewfeed');
    }

    public function postNewFeed(Request $request)
    {
        $message = $request->input('message');
        $link = $request->input('link');
        //$fb = new Facebook();
        //$response = $fb->post(
           // '/me/feed',
           // array (
              //  'message' => $message,
             //   'link'    => $link
              // 'tags' => '100004519381111'
           // ),
          //  env('TOKEN_FACE')
        //);
        $ch = curl_init();
        $url = "https://graph.facebook.com/v1.11/";
        $uri = "me/feed?message=".$message."&link=".$link."&method=POST&access_token=" .Session::get('token');
        $output = $this->getCurl($ch, $url, $uri);
        curl_close($ch);
        return redirect('home');
        }

    public function oneNewFeed($id)
    {
        $idn = $id;
        $ch  = curl_init();
        $url = "https://graph.facebook.com/v2.11/";
        $uri = $idn."/feed?limit=1&access_token=" .Session::get('token');
        $output = $this->getCurl($ch, $url, $uri);
        curl_close($ch);
        $output = json_decode($output);
        return $output->data;
    }

    public function like($id)
    {
        $newfeeds = $this->oneNewFeed($id);
        $ch  = curl_init();
        foreach ($newfeeds as $value) {
            $url = "https://graph.facebook.com/v2.11/";
            $uri = $value->id."/reactions?type=LOVE&method=POST&access_token=" .Session::get('token');
            $output = $this->getCurl($ch, $url, $uri);
        }
        curl_close($ch);
        return redirect('home');
    }

    public function getCurl($ch, $url, $uri)
    {
        $url = $url . $uri;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }

    public function getToken(Request $request)
    {
        $token = $request->input('token');
        if (!empty($token)) {
            Session::put('token', $token);
            $a = Session::get('token');
            return redirect('home');
        } else {
            return redirect('home');
        }
    }

}
