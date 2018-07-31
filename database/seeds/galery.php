<?php

use Illuminate\Database\Seeder;

class galery extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galery_groups')->insert([
            'user_id' => 1,
            'group_name' => 'Группа 1',
            'group_comment' => 'Группа пользователя 1',
        ]);

        DB::table('galeries')->insert([
            'user_id' => 1,
            'galery_group_id' => 1,
            'url_img' => 'galery/user_256x256.png',
            'comment' => 'Картина по-умолчанию',
        ]);
    }
}
