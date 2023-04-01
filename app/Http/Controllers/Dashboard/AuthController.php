<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Dashboard\Auth\LoginApiRequest ;

use App\Models\User ;
use Illuminate\Http\Response ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Resources\Dashboard\Auth\AuthResource;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login( LoginApiRequest $request ) {
        $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;

        if ( Auth::attempt(['email'=>$user->email,'password'=>$request->password]) ){
            return $this -> MakeResponseSuccessful( 
                [
                    'user'  =>   new AuthResource ( Auth::user()   )   , 
                    'Token' => Auth::user() -> getToken( ) 
                ],  
                'Successful' ,
                Response::HTTP_OK
            ) ; 
        }else{
            return $this -> MakeResponseErrors( 
                [ 'InvalidCredentials' ] 
                , 'InvalidCredentials' 
                , Response::HTTP_UNAUTHORIZED 
            ) ;
        }

    
    }
    public function logout( Request $request ) {
        Auth::user()->tokens()->delete(); // Sanctum
        // Auth::user()->token()->revoke();// passport
        // Auth::user()->currentAccessToken()->delete(); // passport
        return $this -> MakeResponseSuccessful( 
            ['Successful' ],
            'Successful' ,
            Response::HTTP_OK
         ) ;
    }
     
}