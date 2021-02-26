<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

    public function create(Request $request){
            $item = Item::create(["content" => $request->content1, "uid" => auth()->guard('api')->user()->id, 'state' => '0']);
    return $item;
    }
    public function delete(Request $request)
    {
        $user=auth()->guard('api')->user();
        if($user->type==1) {
            Item::where("id", $request->id)->where("uid", auth()->guard('api')->user()->id)->delete();
        }
        if($user->type==2){
            Item::where("id", $request->id)->delete();

        }
    }
    public function get(){
        $user=auth()->guard('api')->user();

        if($user->type==1) {
            return json_encode(Item::where("uid",auth()->guard('api')->user()->id)->paginate(10));
        }
        if($user->type==2){
            return json_encode(Item::paginate(10));

        }
    }
    public function update(Request $request)
    {
        $user=auth()->guard('api')->user();

        if($user->type==1) {

            Item::where("id",$request->id)->where("uid",auth()->guard('api')->user()->id)->first()->update(["content"=>$request->content1]);
        }
        if($user->type==2){
            Item::where("id",$request->id)->first()->update(["content"=>$request->content1]);

        }
    }
    public function updatestate(Request $request)
    {
        $user=auth()->guard('api')->user();

        if($user->type==1) {

            Item::where("id", $request->id)->where("uid", auth()->guard('api')->user()->id)->first()->update(["state" => $request->state]);
        }
        if($user->type==2){
            Item::where("id",$request->id)->first()->update(["state"=>$request->state]);

        }
    }
    public function search(Request $request){
//$items=DB::select("Select * from items where content like '%".$request->str."%'")->paginate(10);
        $user=auth()->guard('api')->user();

        if($user->type==1) {
        $items= DB::table('items')->where("content","LIKE","%".$request->str."%")->where("uid","=",$user->id)->paginate(10);
        }
        if($user->type==2){
            $items= DB::table('items')->where("content","LIKE","%".$request->str."%")->paginate(10);

        }
        return json_encode($items);
    }

}
