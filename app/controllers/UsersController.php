<?php

class UsersController extends \BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('username','dsc')->get();
		return View::make("users.index")->withUsers($users);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		if(! $this->user->isValid($input = Input::all()))
		{
			return Redirect::back()->withInput(Input::only('email','username'))->withErrors($this->user->messages);	
		}

		if(Input::get('password') != Input::get('password_confirmation'))
		{
			return Redirect::back()->withInput(Input::only('email','username'))->withErrors($this->user->messages);;
		}

		//$this->user->create($input);

        $this->user->username = Input::get('username');
        $this->user->password = Hash::make(Input::get('password'));
        $this->user->email = Input::get('email');
        $this->user->save();

		return Redirect::route('users.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($username){
		$user = User::whereUsername($username)->first();
	 	return View::make('users.show',['user'=>$user]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
