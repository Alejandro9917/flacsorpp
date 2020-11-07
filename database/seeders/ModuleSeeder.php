<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('modules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('modules')->insert([
            [
                'route_regex' => 'test/*',
                'has_file' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'route_regex' => 'test2/*',
                'has_file' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'route_regex' => 'test3/*',
                'has_file' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'route_regex' => 'test4/*',
                'has_file' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
