<?php

namespace App\Http\Requests\Api\Mobile\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class loginApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $all = [];
        if(is_numeric($this->email_phone)){
            $all += [ 'email_phone'=>  [ 'required' ,'numeric','exists:'.User::class.',phone'] ] ;
        } else{
            $all += [ 'email_phone'=>  [ 'required' ,'email','exists:'.User::class.',email'] ] ;
        }
        $all += [ 'password'=>  [ 'required' ,'string','min:6'] ] ;

        return $all;
    }
}
