<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
        $this->call(LogoTableSeeder::class);
        $this->call(RecordTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserHasRoleTableSeeder::class);

    }
}
