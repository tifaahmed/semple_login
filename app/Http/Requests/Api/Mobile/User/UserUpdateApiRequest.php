<?php

namespace App\Http\Requests\Api\Mobile\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UserUpdateApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $all=[];

        $all += [ 'first_name'               =>  [ 'required'  ] ]  ;
        $all += [ 'last_name'               =>  [  'sometimes'  ] ]  ;

        $all += [ 'email'               =>  [ 'required_without:phone','unique:users,email,'.Auth::user()->id ,'email' ] ]  ;
        $all += [ 'password'               =>  [   'sometimes' ] ]  ;
        $all += [ 'gender'               =>  [   'required' , Rule::in(['male','female']) ] ] ;

        $all += [ 'phone'               =>  [  'required_without:email','unique:users,phone,'.Auth::user()->id ,'max:15'] ]  ;

        $all += [ 'birthdate'               =>  [  'sometimes', 'date'  ] ]  ;
        
        $all += [ 'avatar'               =>  [ 'sometimes','max:50000','mimes:jpg,jpeg,webp,bmp,png' ] ]  ;
        
        $all += [ 'pin_code_email'               =>  [  'numeric', 'unique:users,pin_code_email,'.Auth::user()->id ] ]  ;
        
        $all += [ 'fcm_token'               =>  [  'sometimes'  ] ]  ;

        $all += [ 'latitude'               =>  [  'sometimes'  ] ]  ;
        $all += [ 'longitude'               =>  [  'sometimes'  ] ]  ;


        return $all;
    }
}
