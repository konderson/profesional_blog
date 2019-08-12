<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeedes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'MD.Admin',
            'user_name'=>'admin',
            'role_id'=>1,
            'email'=>'adminblog@gmail.com',
            'password'=>bcrypt('rootadmin'),

        ]);

        DB::table('users')->insert([
            'name'=>'MD.Author',
            'user_name'=>'author',
            'role_id'=>2,
            'email'=>'authorblog@gmail.com',
            'password'=>bcrypt('rootauthor'),

        ]);
    }
}
