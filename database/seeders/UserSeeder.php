<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'id' => "1",
            'name' => "pgrant",
            'email'=>"email@email.com",
                'password'=>Hash::make("password"),
            'type'=>"1",
            "remember_token"=>null,
            "created_at"=>"2021-02-25 14:48:38",
            "updated_at"=>"2021-02-25 14:48:38"
        ]
           );        DB::table('users')->insert(

        [
            'id' => "2",
            'name' => "pgrant",
            'email'=>"email2@email.com",
            'password'=>Hash::make("password"),
            'type'=>"2",
            "remember_token"=>null,
            "created_at"=>"2021-02-25 14:48:38",
            "updated_at"=>"2021-02-25 14:48:38"
        ]);
    }
}
