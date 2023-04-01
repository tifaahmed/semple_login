<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use URL;
use Illuminate\Http\Response ;

use App\Http\Requests\Api\Mobile\Auth\loginApiRequest;
use App\Http\Resources\Mobile\Auth\AuthResource;

class LoginController extends Controller {
 
    public function login(loginApiRequest $request){

        // return object if phone or email exist
        $user = $this->get_user($request->email_phone);
            
        // if the user password wrong
        if ( ! Hash::check( $request -> password , $user -> password ) ) {
            return $this -> MakeResponseErrors( 
                [ 'InvalidCredentials' ],  
                'error' ,
                Response::HTTP_UNAUTHORIZED
            ) ; 
        }

        // return true if email or phone (not) verified        
        else if( $this->check_verification($user) ){
            return $this -> MakeResponseErrors( 
                [ 'acount not verified pincode has been sent' ],  
                'error' ,
                Response::HTTP_UNAUTHORIZED
            ) ;
        }

        else{
            $this->loginUser($user);
            return $this->authResponse();
        }
    }

    public function destroy( Request $request ) {
        Auth::logout();  
        return  redirect(App()->getLocale());
    }
}

