<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'satendramaurya1991@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 1,
        ]);
    }
}
