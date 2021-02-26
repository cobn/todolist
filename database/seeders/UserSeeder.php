<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
        'id' => "1",
            'name' => "pgrant",
            'email'=>"email@email.com",
            'password'=>'$2y$10$avjRe9Ed1iNe3uFX.5UvBOykCBsE7CvJSPehBF4sgYGqSmNqyZdKu',
            'type'=>"1",
            "remember_token"=>null,
            "created_at"=>"2021-02-25 14:48:38",
            "updated_at"=>"2021-02-25 14:48:38"
        ],
            [
                'id' => "2",
                'name' => "pgrant",
                'email'=>"email2@email.com",
                'password'=>'$2y$10$avjRe9Ed1iNe3uFX.5UvBOykCBsE7CvJSPehBF4sgYGqSmNqyZdKu',
                'type'=>"2",
                "remember_token"=>null,
                "created_at"=>"2021-02-25 14:48:38",
                "updated_at"=>"2021-02-25 14:48:38"
            ]);
    }
}
