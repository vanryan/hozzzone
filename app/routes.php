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
Index
*/
Route::get('/',   
	array(
		'as'=>'index',
		function(){
            if(Auth::check()) {
                $viewer = 'square'; 
                // see if user has a pre-selected viewer
                // and put it in $viewer...


                // Here I send stuff into the default or dynatorrent view 

                // Settings
				$default_item_num = 5;  // The number of items(Big pictures in default page)
				// End of settings

                require_once('bladehandlers/default_items_hdlr.php');
                
                require_once('jsonhandlers/initjson_hdlr.php');            

                $defaultItems = array(
                	'uid'=>'defaultItems',
                	'name'=>'defaultItems',
                	'attrs'=>(object)array( 'className'=>'default' ),
                	'data'=>(object)array( 'createdAt'=>date('YmdHis',time()) ),
                	'children'=>$defitems
                	);

                $defaultItems = (object)$defaultItems;

                $initJSON = array(
					'modules' => array(
						'uid'=>'app',
						'name'=>'app',
						'children'=>array(
							$defaultItems, $rightBar, $nav
							)
						)
					);

				return View::make('viewer.' . $viewer, array(
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
                    'initJSON' => json_encode($initJSON),
                    
                    // @ $viewer: a string for determining active icon in '.rightBar .layout'
                    'viewer' => $viewer
					));
            }
			else
				return View::make('guests.new');
		})
	);

/*
Here is a route group after authentication
*/

Route::group(array('before' => 'auth'), function()
{
    
});


/*
Abort
*/
Route::get('index.php',function(){
		return View::make('officials.abort');
	});

Route::get('sessions/{param}',function(){
		return View::make('officials.abort');
	});

Route::get('users/store',function(){
		return View::make('officials.abort');
	});

/*
Authentication
*/
Route::get('login','SessionsController@create');

Route::get('logout','SessionsController@destroy');

Route::get('signin','SessionsController@create');

Route::get('signout','SessionsController@destroy');

Route::resource('sessions','SessionsController');


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

Route::resource('users','UsersController'); // Resourceful routing



/*
Not sure now
*/

Route::get('users/destroy',function(){
			//return View::make('officials.abort');
		});

Route::group(array('before' => 'csrf'), function()
{
    
});


