<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\NewPasswordVerificationNotification;
use App\Providers\RouteServiceProvider;
use Ichtrojan\Otp\Otp;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
  private $otp;

  public function __construct(){

    $this->otp = new Otp;

  }

  public function passwordReset(ResetPasswordRequest $request){

    $otp2=$this->otp->validate($request->email,$request->otp);
    if(! $otp2->status){

        return response()->json(['error'=>$otp2],401);
    }
    $user =User::where('email',$request->email)->first();
    $user->update(['password'=> Hash::make($request->password)]);
    $user->notify(new NewPasswordVerificationNotification());
    $user->tokens()->delete();
    $success['success']=true;

    return response()->json($success,200);

  }
}
