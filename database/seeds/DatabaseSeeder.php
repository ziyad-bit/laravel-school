<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i=400; $i <3000 ; $i++) { 
            DB::table('users')->insert([
                'name'     => 'ziyad'.$i,
                'term'     => 1,
                'level_id' => 2,
                'email'    => 'ziyad199523'.$i.'@yahoo.com',
                'password' => Hash::make('ziyad12'),
            ]);
        }
    }
}
