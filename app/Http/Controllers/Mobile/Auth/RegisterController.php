<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use URL;
use Illuminate\Http\Response ;

use App\Http\Requests\Api\Mobile\Auth\RegisterApiRequest ;

class RegisterController extends Controller {
 
    public function register( RegisterApiRequest $request ) {
        $user = $this->store_user($request) ; // store user 


        if ($request->email) {
            // $this->check_email_verified($user); // send link to user email 
        }
        if ($request->phone) {
            // $this->OtpSend($user->phone);// send pin code to user phone
        }
         $this->loginUser($user); // login
        // login Response
        return $this->authResponse();
    }
}

