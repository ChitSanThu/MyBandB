<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('records')->insert([
                'month'=>date("m"),
                'year'=>date("Y")
            ]);
    }
}
