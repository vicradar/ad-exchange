<?php

class LoginController extends BaseController {

	public function showLogin()
	{
		return View::make('login');
	}

	public function tryLogin()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if (Auth::attempt(['email' => $username, 'password' => $password, 'isActive' => true])) {
			if (Auth::guest()) {
				$errorMessage = "Success, but broke";
			} else {
				return Redirect::intended('/adlist');
			}
		} else {
			$errorMessage = "Incorrect username or password.";
		}

		return View::make('login', ['errorMessage' => $errorMessage]);
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::action('LoginController@showLogin');

	}
}