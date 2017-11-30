<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserInterface;
use App\User;

class UserRepository implements UserInterface
{
	public function addUser($user)
	{
		$createdUser = User::Create([
	        'name'     => $user->name,
	        'email'    => $user->email,
	        'password' => bcrypt('abcde'),
	        'avatar'   => $user->avatar,
	        'remember_token' => $user->token
		]);
		return $createdUser;
	}
}



