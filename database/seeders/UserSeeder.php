<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Daniel',
                'email' => 'dani@dani.com',
                'password' => '12345'
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Sergio',
                'email' => 'sergio@sergio.com',
                'password' => 'princess'
            ]
        );
    }
}
