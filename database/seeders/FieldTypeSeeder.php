<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('field_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('field_types')->insert([
            [
                'display_name' => 'Simple Text',
                'type' => 'text',
                'json_template' => '
{
    "min_length": "10",
    "max_length": "10",
    "regex": ""
}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'display_name' => 'Simple Date',
                'type' => 'date',
                'json_template' => '
{
    "max_length": "2020/12/12",
    "min_date": "2020/12/12",
    "format": "YYYY/mm/dd"
}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'display_name' => 'Simple Number',
                'type' => 'number',
                'json_template' => '
{
    "min": "2020/12/12",
    "mac": "2020/12/12",
    "use_spinner": true,
    "decimal_places": 2,
    "icon": "fa fa-currency"
}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'display_name' => 'Simple Checkbox',
                'type' => 'checkbox',
                'json_template' => '
{
    "min_selected": 1,
    "max": 2,
    "options": [
        {
        "text": "Opción A",
        "value": "opcion_a_value",
        "selected": true
        },
        {
        "text": "Opción B",
        "value": "opcion_b_value",
        "selected": false
        },
        {
        "text": "Opción C",
        "value": "opcion_C_value",
        "selected": false
        }
    ]
}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'display_name' => 'Simple Spinner',
                'type' => 'select',
                'json_template' => '
{
    "min_selected": 1,
    "max": 1,
    "options": [
        {
        "text": "Opción A",
        "value": "opcion_a_value",
        "selected": true
        },
        {
        "text": "Opción B",
        "value": "opcion_b_value",
        "selected": false
        },
        {
        "text": "Opción C",
        "value": "opcion_C_value",
        "selected": false
        }
    ]
}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
