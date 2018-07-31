<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  DB::table('permissions')->truncate();
        DB::table('permissions')->insert([
            'id' => '1',
            'name' => 'PR_ADMIN',
            'comment' => 'Привелегия администратора',
            'active' => 1,
        ]);
        DB::table('permissions')->insert([
            'id' => '2',
            'name' => 'PR_USER',
            'comment' => 'Привелегия пользователей',
            'active' => 1,
        ]);
    }
}
