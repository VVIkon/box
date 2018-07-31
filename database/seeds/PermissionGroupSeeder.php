<?php

use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('permission_groups')->truncate();
        DB::table('permission_groups')->insert([
            'id' => '1',
            'name' => 'USER_GROUP',
            'comment' => 'Группа пользователей',
            'permission_arr' => '2',
        ]);
        DB::table('permission_groups')->insert([
            'id' => '100',
            'name' => 'ADMIN_GROUP',
            'comment' => 'Группа администратора',
            'permission_arr' => '1,2',
        ]);
    }
}
