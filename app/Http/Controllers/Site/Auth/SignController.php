<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use URL;
// lInterfaces
use App\Repository\PageDetailRepositoryInterface;

use App\Http\Requests\Mvc\Site\Auth\loginRequest;
class SignController extends Controller {
    public function __construct(PageDetailRepositoryInterface $PageDetailRepository,){
        $this->PageDetailRepository = $PageDetailRepository;
    }
    public function index(){
        // Session::put('login_previous',(string) $url);

        $data['page_detail_login']    = $this->PageDetailRepository->findById('4',['*'],['page_seo'])    ;
        return  view( 'pages.auth.login',$data );
    }
    public function login(loginRequest $request){

        // return object if phone or email exist
        $user = $this->get_user($request->email_phone); 

        // return true if email or phone (not) verified        
        // if( $this->check_verification($user) ){
        //     return redirect()->back()
        //     ->withErrors('auth.failed');
        // }
        
        // login user
        // else {
            $this->loginUser($user,$request);

            return redirect()->to( \app()->getLocale().'/profile/customer/dashboard/'.$user->user_name);
        // }
    }
    public function destroy( Request $request ) {
        Auth::logout();  
        return  redirect(App()->getLocale());
    }
}

