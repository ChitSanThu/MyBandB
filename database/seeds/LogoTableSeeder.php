<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            'title' => "MyB&B GHMS",
            'address' => "5 block, South OkKaLaPa Township, Yangon",
            'phone' => "09797734075",
            'logo' => "logo.png",
            'tax' => 0

        ]);
    }
}
