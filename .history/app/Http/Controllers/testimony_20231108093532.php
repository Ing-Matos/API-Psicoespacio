<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\testimony;

class testimony extends Controller
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
    }
}
