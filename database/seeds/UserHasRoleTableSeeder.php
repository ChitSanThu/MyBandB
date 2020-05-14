<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHasRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_has_roles')->insert([
            "role_id"=>1,
            "user_id"=>4
        ]);
    }
}
