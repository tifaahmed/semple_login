<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

 
Route::group(['prefix' =>'mobile','middleware' => ['LocalizationMiddleware']], fn ( ) : array => [

    // auth
    Route::name( 'auth.') -> prefix( 'auth') -> group( fn ( ) => [

        Route::post( '/login' ,   'Auth\LoginController@login'  ) -> name( 'login' ) ,
        Route::post( '/register' ,  'Auth\RegisterController@register' )  -> name( 'register' ) ,
        Route::post( '/active-acount' ,  'AuthController@active_acount' )  -> name( 'active_acount' ) , 
        Route::post( '/check-pin-code' ,  'Auth\ForgetPassword\CheckPinCodeController@check_pin_code' )  -> name( 'check_pin_code' ) , 

    ]),
    Route::group(['middleware' => ['auth:sanctum']], fn ( ) : array => [
        // auth
        Route::name( 'auth.') -> prefix( 'auth') -> group( fn ( ) => [
            Route::post( 'logout' ,  'authController@logout' )  -> name( 'logout' ) ,
        ]),
        // user
        Route::name('user.')->prefix('/user')->group( fn ( ) : array => [
            Route::get('/show'                 ,   'UserController@show'                )->name('show'),
            Route::post('/update'              ,   'UserController@update'              )->name('update'),
        ]), 
    ]),
]); 
  