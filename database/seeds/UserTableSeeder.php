<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Demo',
            'email' => 'demo@user.com',
            'password' => bcrypt('secret'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
