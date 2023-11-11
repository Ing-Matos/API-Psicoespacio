<?php
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\testimonialsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::post('login',[UsersController::class,'login']);
Route::post('register',[UsersController::class,'register']);

Route::post('password/forgot-password',[ForgotPasswordController::class,'forgotPassword']);
Route::post('password/reset',[ResetPasswordController::class,'passwordReset']);

Route::post('verify_email',[UsersController::class,'verify_email']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    //user
    Route::get('profile', [UsersController::class, 'profile']);
    Route::post('logout', [UsersController::class, 'logout']);
    Route::get('users_list', [UsersController::class, 'users_list']);
    Route::post('update/{id}', [UsersController::class, 'update']);
    Route::delete('delete/{id}', [UsersController::class, 'delete']);

    //testimonials
    Route::post('testimonials/register',[testimonialsController::class,'register_tes']);
    Route::get('testimonials/list',[testimonialsController::class,'list_testimonials']);
    Route::post('testimonials/update/{id}',[testimonialsController::class,'testimonials_update']);

});

// de aqui para abajo lo agregas arriba pls
Route::prefix('clientes')->group(function () {
   Route::get('/', [ClienteController::class, 'index']);
   Route::post('/store', [ClienteController::class, 'store']);
   Route::get('/{cliente}/show', [ClienteController::class, 'show']);
   Route::put('/{cliente}/update', [ClienteController::class, 'update']);
   Route::delete('/{cliente}', [ClienteController::class, 'destroy']);
});
Route::prefix('citas')->group(function () {
    Route::get('/', [CitasController::class, 'index']);
    Route::post('/store', [CitasController::class, 'store']);
    Route::get('/{cliente}/show', [CitasController::class, 'show']);
    Route::put('/{cliente}/update', [CitasController::class, 'update']);
    Route::delete('/{cliente}', [CitasController::class, 'destroy']);
 });
 Route::prefix('medicos')->group(function () {
    Route::get('/', [MedicoController::class, 'index']);
    Route::post('/store', [MedicoController::class, 'store']);
    Route::get('/{cliente}/show', [MedicoController::class, 'show']);
    Route::put('/{cliente}/update', [MedicoController::class, 'update']);
    Route::delete('/{cliente}', [MedicoController::class, 'destroy']);
 });

