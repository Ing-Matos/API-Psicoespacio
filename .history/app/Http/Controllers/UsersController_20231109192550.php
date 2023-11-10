<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\verifyNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function register (Request $request){
        //Validacion de los datos 
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone'=>'required|unique:users',
            'birthdate'=>'required'

        ]);
        


        $User = new User();
        $User -> full_name = $request->full_name;
        $User -> email = $request->email;
        $User -> password = Hash::make($request->password);
        $User -> photo = 'default';
        $User -> birthdate = $request->birthdate;
        $User -> status = 0;
        $User -> code_email= Str::random(6);
        $User -> role = 1;
        $User -> phone = $request -> phone;

        
        $User->save();

        $User->notify(new verifyNotifications());
        

        return response(["message"=>"save user"],Response::HTTP_CREATED);
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token);
            return response(["token"=>$token,"role"=>$user->role,"status"=>$user->status], Response::HTTP_OK)->withoutCookie($cookie);
        } else {
            return response(["message"=> "Invalid credentials"],Response::HTTP_UNAUTHORIZED);
        }        
    }
    public function profile(Request $request) {
        return response()->json([
            "user_profile" => auth()->user()
        ], Response::HTTP_OK);
    }
    
    public function logout() {
        $cookie = Cookie::forget('cookie_token');
        return response(["message"=>"Log out"], Response::HTTP_OK)->withCookie($cookie);
    }

    public function users_list() {
       $users = User::all();
       return response()->json([
        "users" => $users
       ]);
    }
    public function update (Request $request, $id)
    {

        if($request->photo!=null && $request->photo !=='undefined'){

            $use = User::findOrFail($id);
            $url=str_replace("storage","public", $use->photo);

            Storage::delete($url);

        }

        if($request->photo !=='undefined'){

            $path = $request->photo->store('public/perfil');
            $url= Storage::url($path);
        }

        $user = User::findOrFail($id);

        $user -> full_name = $request->full_name;

        if($request->password !=null || $request->password !=''){
            $user -> password = Hash::make($request->password);
        }

        if( $request->photo !== 'undefined'){

            $user->photo=$url;
        }

        $user->save();
        

        return response(["message"=> "edited user"],Response::HTTP_CREATED);
        
    }

    public function delete(Request $request)
    {
        $user=User::findOrFail($request->id);
        $url=str_replace("storage","public", $user->photo);
         Storage::delete($url);
        $user->destroy($request->id);
        return response(["message"=> "deleted user"],Response::HTTP_OK);
    }

    public function verify_email(Request $request){

        $user =User::where('email', $request->email)->where('code_email',$request->code_email)->first();
    
        $user->status = 2;

        $user->save();

        return response(['message'=> 'OK'],Response::HTTP_OK);

    }

}