<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed

        DB::table('users')->insert([
        	'name' => 'Sam Alcaraz',
        	'email' => 'sam_zerox@hotmail.com',
        	'password' => bcrypt('123456'),
        	]);
    }
}
