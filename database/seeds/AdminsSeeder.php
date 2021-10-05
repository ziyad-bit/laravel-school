<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'     => 'ziyad',
            'email'    => 'ziyad199523@yahoo.com',
            'password' => Hash::make('ziyad12'),
        ]);
    }
}
