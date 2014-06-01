<?php
	
class SessionsController extends \BaseController{
	
	public function create()
	{
		if(Auth::check()) // Already signed in
			return Redirect::intended('/');  // Redirect::intended leads the user to the url before authentication. If there's none, go to the parameter.

		return View::make('sessions.create');
	}

	public function store()
	{
		// Authenticating the user
		if( Auth::attempt( array('email'=>Input::get('email'),'password'=>Input::get('password') ) ) )
		{
			return Redirect::intended('/');
		}
		
		return Redirect::intended('/');
	}

	public function destroy(){

		Auth::logout();

		return Redirect::route('sessions.create');
	}

}

?>