<?php

use Illuminate\Database\Seeder;

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
            "user_id"=>1
        ]);
    }
}
