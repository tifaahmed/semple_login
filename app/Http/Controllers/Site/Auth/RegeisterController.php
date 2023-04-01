<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
// lInterfaces
use App\Repository\PageDetailRepositoryInterface;

use App\Http\Requests\Mvc\Site\Auth\RegisterApiRequest;

class RegeisterController extends Controller {
    public function __construct(PageDetailRepositoryInterface $PageDetailRepository,){
        $this->PageDetailRepository = $PageDetailRepository;
    }
    public function index(){
        $data['page_detail_register']    = $this->PageDetailRepository->findById('6',['*'],['page_seo'])    ;
        return  view( 'pages.auth.register',$data );
    }
    public function register( RegisterApiRequest $request ) {
        $user = $this->store_user($request) ; // store user 
        $user->address()->create();

        // event(new Registered($user));
        // if ($request->email) {
            // $this->check_email_verified($user); // send pin code to user email
        // }

        // if ($request->phone) {
        //     $this->OtpSend($user->phone);
        // }
         $this->loginUser($user); // login

        // login Response
        return redirect()->to( \app()->getLocale().'/profile/customer/dashboard/'.$user->user_name);
    }
}

