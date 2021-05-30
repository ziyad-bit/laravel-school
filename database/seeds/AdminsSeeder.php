<?php

use Illuminate\Database\Seeder;

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
