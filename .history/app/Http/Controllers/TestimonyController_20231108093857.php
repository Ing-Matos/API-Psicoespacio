<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\testimony;

class testimonyController extends Controller
{
    public function register_testimony(Request $request){
        $request->validate([
            "title"=> "required",
            "body"=> "required",
            "id_user"=> "required",
            "user_name"=>  "required",
            "photo_user"=> "required"
        ]);

        $testimony= new testimony();
        $testimony->title = $request->title;
        $testimony->body = $request->body;
        $testimony->user_id = $request->user_id;
        $testimony->user_name=  $request->user_name;
        $testimony->photo_user=  $request->photo_user;
        $testimony->save();
    }
}
