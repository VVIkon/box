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
        // $this->call(UsersTableSeeder::class);
//        $this->call(PermissionSeeder::class);
//        $this->call(PermissionGroupSeeder::class);
//        $this->call(galery::class);
        $this->call(store::class);
    }
}
