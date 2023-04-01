<?php

use Illuminate\Support\Facades\Route;

Route::get('storage_link', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});
Route::get('permissions_update', function (){
    \Illuminate\Support\Facades\Artisan::call('permissions:update');
    echo 'ok';
});
Route::get('/dashboard/{any}','AdminPanelController@admin_panel')-> where( 'any' , '.*' )-> name( 'admin' ) ;
Route::get( '/dashboard', function ($token) {
    return  view( 'admin-panel' );
}) ;

Route::get('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'done';
});


