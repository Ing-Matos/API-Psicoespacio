<?php

namespace App\Http\Controllers;

use App\Models\testimonials;
use Illuminate\Http\Request;

class testimonialsController extends Controller
{
    public function register_tes(Request $request){

        $testimony= new testimonials();

        $testimony->title =$request->title;
        $testimony->body= $request->body;
        $testimony->user_name= $request->user_name;
        $testimony->user_id= $request->user_id;
        $testimony->user_photo= $request->user_photo;

        $testimony->save();

    }
}
