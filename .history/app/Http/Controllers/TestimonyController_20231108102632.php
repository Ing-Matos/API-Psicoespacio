<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\testimony;
use Symfony\Component\HttpFoundation\Response;

class testimonyController extends Controller
{
    public function register_testimony(Request $request){
        

        $testimony= new testimony();
        $testimony->title = $request->title;
        $testimony->body = $request->body;
        $testimony->id_user = $request->id_user;
        $testimony->user_name=  $request->user_name;
        $testimony->photo_user=  $request->photo_user;
    
        $testimony->save();

        
    }
}
