<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name' => 'Ale',
            'email' => 'alejandromelendez99@outlook.es',
            'password' => bcrypt('123'),
            'first_name' => 'Miguel',
            'second_name' => 'Alejandro',
            'first_lastname' => 'Meléndez',
            'second_lastname' => 'Martínez',
            'birthday' => '1999-08-11 18:00:00',
            'status' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')     
        ]     
        ]);
    }
}
