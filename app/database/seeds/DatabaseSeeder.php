<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		/*
		The Eloquent::unguard(); line is simply telling Eloquent to allow mass assignment. 
		When seeding your database you obviously don’t have to worry about mass assignment, 
		so it makes this process a whole lot easier if you just turn it off.
		*/

		$this->call('UserTableSeeder');

        $this->call('ImageIndsTableSeeder');

        $this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('users')->delete();  Deleting All Records From A Table

    	/* Paradigms
        User::create(
        	array(
        		'email' => '@pizazz.com',
        		'username' => '',
        		'password' => Hash::make(''),
        		'icon' => '.jpg',
        		'ucity' => 'Bridgetown',
        		'udepict' => 'I am a test figure!'
        		)
        	);

        */

        User::create(
        	array(
        		'email' => 'zack@pizazz.com',
        		'username' => 'zack',
        		'password' => Hash::make('zackpass'),
        		//'icon' => sha1('zack'. date("YmdHis",time())). rand(10,74) . '.jpg',
                'icon' => 'zack.jpg',
        		'ucity' => 'Bridgetown',
        		'udepict' => 'I am a test figure!'
        		)
        	);

        User::create(
        	array(
        		'email' => 'zakas@pizazz.com',
        		'username' => 'zakas',
        		'password' => Hash::make('zakaspass'),
        		//'icon' => sha1('zakas'. date("YmdHis",time())). rand(10,74) . '.jpg',
                'icon' => 'zakas.jpg',
        		'ucity' => 'Bridgetown',
        		'udepict' => 'I am a test figure!'
        		)
        	);

        User::create(
        	array(
        		'email' => 'faust@pizazz.com',
        		'username' => 'faust',
        		'password' => Hash::make('faustpass'),
        		//'icon' => sha1('faust'. date("YmdHis",time())). rand(10,74) . '.jpg',
                'icon' => 'faust.jpg',
        		'ucity' => 'Bridgetown',
        		'udepict' => 'I am a test figure!'
        		)
        	);

		
    }

}

class ImageindsTableSeeder extends Seeder {

    public function run()
    {
        Imageind::create(
            array(
                'filename' => 'doge1.jpg',
                'upuid' => 1,
                'upuname' => 'zack',
                'upuicon' => 'zack.jpg',
                )
            );
        Imageind::create(
            array(
                'filename' => 'doge2.jpg',
                'upuid' => 1,
                'upuname' => 'zack',
                'upuicon' => 'zack.jpg',
                )
            );
        Imageind::create(
            array(
                'filename' => 'doge3.jpg',
                'upuid' => 1,
                'upuname' => 'zack',
                'upuicon' => 'zack.jpg',
                )
            );
        Imageind::create(
            array(
                'filename' => '金馆长.jpg',
                'upuid' => 2,
                'upuname' => 'zakas',
                'upuicon' => 'zakas.jpg',
                )
            );
        Imageind::create(
            array(
                'filename' => '哈士奇.jpg',
                'upuid' => 3,
                'upuname' => 'faust',
                'upuicon' => 'faust.jpg',
                )
            );
    }
}