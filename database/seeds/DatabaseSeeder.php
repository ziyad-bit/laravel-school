<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'ziyad',
            'term'     => 1,
            'level_id' => 2,
            'email'    => 'ziyad199523@yahoo.com',
            'password' => Hash::make('ziyad12'),
        ]);
    }
}
