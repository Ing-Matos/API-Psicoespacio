<?php
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::post('login',[UsersController::class,'login']);
Route::post('register',[UsersController::class,'register']);

Route::post('password/forgot-password',[ForgotPasswordController::class,'forgotPassword']);
Route::post('password/reset',[ResetPasswordController::class,'passwordReset']);



Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('profile', [UsersController::class, 'profile']);
    Route::post('logout', [UsersController::class, 'logout']);
    Route::get('users_list', [UsersController::class, 'users_list']);
    Route::post('update/{id}', [UsersController::class, 'update']);
    Route::delete('delete/{id}', [UsersController::class, 'delete']);
});

