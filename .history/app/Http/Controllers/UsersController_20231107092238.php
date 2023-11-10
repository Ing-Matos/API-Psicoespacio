<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function register (Request $request)
    {
        //Validacion de los datos 
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'photo' => 'required|image|dimensions:min_width=200,min_height=200',
            'phone'=>'required|unique:users',
            'birthdate'=>'required',
            'status' => 'required',
            'role'=>'required'

        ]);
        

        $path = $request->photo->store('public/perfil');

        $url= Storage::url($path);

        $User = new User();
        $User -> full_name = $request->full_name;
        $User -> email = $request->email;
        $User -> password = Hash::make($request->password);
        $User -> photo = $url;
        $User -> birthdate = $request->birthdate;
        $User -> status = $request -> status;
        $User -> role = $request -> role;
        $User -> phone = $request -> phone;

        
        $User->save();

        $User->sendEmailVerificationNotification();
        

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
            $cookie = cookie('cookie_token', $token, 60*24);
            return response(["token"=>$token,"role"=>$user->role], Response::HTTP_OK)->withoutCookie($cookie);
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

        if($request->photo!=null || $request->password !=''){

            $use = User::findOrFail($id);
            $url=str_replace("storage","public", $use->photo);

            Storage::delete($url);
        }

        $path = $request->photo->store('public/perfil');
        $url= Storage::url($path);

        $user = User::findOrFail($id);

        $user -> full_name = $request->full_name;
        $user -> phone = $request->phone;

        if($request->password !=null || $request->password !=''){
            $user -> password = Hash::make($request->password);
        }

        if($request->photo != null || $request->photo != ''){

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


}
