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
            if(!Auth::check()) {

                $items = array(
                    (object)array('avatar'=>'long.jpg',
                        'img'=>'davinci.jpg',
                        'hit'=>'1092',
                        'title'=>'da vinci',
                        'subItems'=>array('demon.jpg', 'orphan.jpg')
                    ),
                    (object)array('avatar'=>'long.jpg',
                        'img'=>'demon.jpg',
                        'hit'=>'234',
                        'title'=>'the demons inside da vinci',
                        'subItems'=>array('davinci.jpg', 'orphan.jpg')
                    ),
                    (object)array('avatar'=>'long.jpg',
                        'img'=>'orphan.jpg',
                        'hit'=>'832',
                        'title'=>'orphan black',
                        'subItems'=>array('davinci.jpg', 'demon.jpg')
                    )
                );


                $viewer = 'default'; 
                // see if user has a pre-selected viewer
                // and put it in $viewer...

				return View::make('viewer.' . $viewer, array('items' => $items));
            }
			else
				return View::make('guests.new');
		})
	);

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


