<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use OAuth;

class ApiController extends Controller
{
    public function generate(){
        $item= DB::table('oauth_clients')->first();
        $item->id=rand(1000000000000000,999999999999999999);
        $array = (array) $item;
create_token();
        DB::table('oauth_clients')->insert(
        );
        OAuth::jwt
    }

}
