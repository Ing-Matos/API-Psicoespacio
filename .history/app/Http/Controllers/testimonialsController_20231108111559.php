<?php

namespace App\Http\Controllers;

use App\Models\testimonials;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        return response(["message"=>"save user"],Response::HTTP_CREATED);

    }

    public function list_testimonials(){
        $testimony = testimonials::all();
        return response()->json([
         "testimonials" => $testimony
        ]);
    }

    public function testimonials_update(Request $request, $id){

    }
}
