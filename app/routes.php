<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Requirements
*/
require_once 'dataplanes/dataplane_main.php';

require_once 'bladehandlers/blade_data_main.php';

require_once 'jsonhandlers/json_hdlr_main.php';

/*
Tests
*/
Route::get('/test',function(){
	//return Session::token();
});

/*
Index
*/

Route::get( '/',
	array(
		'as'=>'index',
		function() {
			if ( Auth::check() ) {
				// If The Request Is Not Using AJAX
				$user = Auth::user();
				$viewer = $user->udefview;
				$viewer = Config::get( 'hoz_global_vars.udefview.'.$viewer );

				// see if user has a pre-selected viewer
				// and put it in $viewer...


				// Here I send stuff into the default or dynatorrent view


				$items = hoz_blade_data_factory::factory( 'show', $viewer.'Items', 'items' );

				$initJSON = hoz_json_factory::factory( 'init', 'app', $viewer.'Items' );

				//var_dump($initJSON); exit();

				return View::make( 'viewer.' . $viewer, array(
						// The default means 'dynatorrent' styled index page
						// That takes parameters:
						// @ $items: object: the info of pics sent to the authed user
						// $items as $key=>$item
						// $item->avatar: the icon of the author of a picture
						// $item->authorname: the name of the pic author (for the hovering)
						// $item->img: a pic sent to the user (filename)
						// $item->title: the title of the pic
						// $item->hit: times the pic get liked
						//
						//$items
						'items' => $items,

						// @ $initJSON: a json array for initiating the apps
						//$initJSON
						'initJSON' => json_encode( $initJSON ),

						// @ $viewer: a string for determining active icon in '.rightBar .layout'
						'viewer' => $viewer
					) );
			}
			else
				return Redirect::to('signin');
		} )
);

/*
Ajax
*/
Route::get( '/resources/{intention}/{method}', function() {

		/*
		@e.g.
		/resources/defaultItems/get
		@end- e.g.

		@parameters
		intention: 'defaultItems' ...
		method: get
		*/

		//Not sure if the validation is needed or not
		//if(Session::token() !== Input::get( '_token' ))
		//	return 'Gotcha, dude!';

		if ( Request::ajax() ) {
			// If The Request Is Using AJAX

			$ajaxJSON = hoz_json_factory::factory( 'ajax', 'sec', $intention, $method, Input::get('data'));

			return Response::json($ajaxJSON);

			//> End- sub situation 2-1
			//> End- Situation 2


		} // end- if(Request::ajax())
	} );

Route::post( '/resources/{intention}/{method}', function() {

		/*
		@parameters
		intention: 'defaultItems' ...
		method: get, create, update, delete
		*/
		if(Session::token() !== Input::get( '_token' ))
			return 'Gotcha, dude!';

		if ( Request::ajax() ) {


		} // end- if(Request::ajax())
	} );



/*
Here is a route group after authentication
*/

Route::group( array( 'before' => 'auth' ), function() {

	} );


/*
Abort
*/
Route::get( 'index.php', function() {
		return View::make( 'officials.abort' );
	} );

//Route::get('sessions/{param}',function(){
//  return View::make('officials.abort');
// });

Route::get( 'users/store', function() {
		return View::make( 'officials.abort' );
	} );

/*
Authentication
*/
Route::get( 'login', 'SessionsController@create' );

Route::get( 'logout', 'SessionsController@destroy' );

Route::get( 'signin', 'SessionsController@create' );

Route::get( 'signout', 'SessionsController@destroy' );

Route::resource( 'sessions', 'SessionsController' );


/*
Users:
users.index
users.create
users.store
users.show
users.show
users.edit
users.update
users.destroy
*/

Route::resource( 'users', 'UsersController' ); // Resourceful routing



/*
Not sure now
*/

Route::get( 'users/destroy', function() {
		//return View::make('officials.abort');
	} );

Route::group( array( 'before' => 'csrf' ), function() {

	} );
