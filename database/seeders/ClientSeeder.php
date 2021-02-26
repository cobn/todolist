<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => "92d1072d-b9df-41bb-bc4f-be3325f96b53",
            'user_id' => null,
            'name' => "pgrant",
            'secret'=>"0H245t2WaxjKz1bggcP1ErS37lvndjlbjYk3kqwl",
            'provider'=>"users",
            'redirect'=>"http://localhost",
            "personal_access_client"=>"0",
            "password_client"=>"1",
            "revoked"=>"0",
            "created_at"=>"2021-02-25 14:48:38",
            "updated_at"=>"2021-02-25 14:48:38"
        ]);
    }
}
