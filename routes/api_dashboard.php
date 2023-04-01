<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// no middleware
Route::name( 'auth.') -> prefix( 'auth' ) -> group( fn ( ) => [
    Route::post( '/login' ,   'AuthController@login'  ) -> name( 'login' ) ,
]);
Route::name('language.')->prefix('/language')->group( fn ( ) : array => [
    Route::get('/'                          ,   'LanguageController@all'                 )->name('all'),
]);
Route::group(['middleware' => []], fn ( ) : array => [
    // Site-Setting
    Route::name('site-setting.')->prefix('/site-setting')->group( fn ( ) : array => [
        Route::get('/'                          ,   'SiteSettingController@all'                 )->name('all'),
        Route::get('/{id}/show'                 ,   'SiteSettingController@show'                )->name('show'),
        Route::get('/collection'                ,   'SiteSettingController@collection'          )->name('collection'),
    ]),
]);  
Route::group(['middleware' => ['LocalizationMiddleware','auth:sanctum','role:admin','PermissionHandler']], fn ( ) : array => [
    
    Route::name( 'auth.') -> prefix( 'auth' ) -> group( fn ( ) => [
        Route::post( '/logout' ,   'AuthController@logout'  ) -> name( 'logout' ) ,
    ]),
    Route::name('site-setting.')->prefix('/site-setting')->group( fn ( ) : array => [
        Route::post('/{id}/update'              ,   'SiteSettingController@update'              )->name('update'),
    ]),
    Route::name('user.')->prefix('/user')->group( fn ( ) : array => [
        Route::get('/'                          ,   'UserController@all'                 )->name('all'),
        Route::post(''                          ,   'UserController@store'               )->name('store'),
        Route::get('/{id}/show'                 ,   'UserController@show'                )->name('show'),
        Route::get('/collection'                ,   'UserController@collection'          )->name('collection'),
        Route::post('/{id}'                   ,   'UserController@destroy'             )->name('destroy'),
        Route::post('/{id}/update'              ,   'UserController@update'              )->name('update'),
        
        Route::get('/{id}/restore'              ,   'UserController@restore'             )->name('restore'),
        Route::post('premanently-post/{id}' ,   'UserController@premanently_post'  )->name('premanently_post'),
        Route::get('/collection-trash'          ,   'UserController@collection_trash'    )->name('collection_trash'),
        Route::get('/{id}/show-trash'           ,   'UserController@show_trash'          )->name('show_trash'),
    ]),
    Route::name('role.')->prefix('/role')->group( fn ( ) : array => [
        Route::get('/'                          ,   'RoleController@all'                 )->name('all'),
        Route::post(''                          ,   'RoleController@store'               )->name('store'),
        Route::get('/{id}/show'                 ,   'RoleController@show'                )->name('show'),
        Route::get('/collection'                ,   'RoleController@collection'          )->name('collection'),
        Route::post('/{id}'                   ,   'RoleController@destroy'             )->name('destroy'),
        Route::post('/{id}/update'              ,   'RoleController@update'              )->name('update'),
    ]),
    Route::name('permission.')->prefix('/permission')->group( fn ( ) : array => [
        Route::get('/'                          ,   'PermissionController@all'                 )->name('all'),
        Route::post(''                          ,   'PermissionController@store'               )->name('store'),
        Route::get('/{id}/show'                 ,   'PermissionController@show'                )->name('show'),
        Route::get('/collection'                ,   'PermissionController@collection'          )->name('collection'),
        Route::post('/{id}'                   ,   'PermissionController@destroy'             )->name('destroy'),
        Route::post('/{id}/update'              ,   'PermissionController@update'              )->name('update'),
    ]),
]);
    