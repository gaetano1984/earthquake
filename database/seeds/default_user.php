<?php

use \App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class default_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $u = new User();

        $check = $u->where('email', 'demo@demo.it')->get();

        if($check->count()==0){
	        $u->name = 'demo';
	        $u->surname = 'demo';
	        $u->email = 'demo@demo.it';
	        $u->password = Hash::make('pippo');

	        $u->save();	
        }
    }
}
