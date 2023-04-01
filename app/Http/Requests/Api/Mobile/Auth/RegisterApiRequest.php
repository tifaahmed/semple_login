<?php

namespace App\Http\Requests\Api\Mobile\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterApiRequest extends FormRequest
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


    public function rules()
    {
        return [
            'first_name'      =>  [ 'sometimes' ,'max:50'] ,
            'last_name'      =>  [ 'sometimes' ,'max:50'] ,

            'email'     =>  [ 'required_without:phone', 'unique:users,email' ,'email','max:200'] ,
            'phone'     =>  [ 'required_without:email', 'unique:users,phone' ,'max:15' ] ,

            'password'  =>  [ 'sometimes' , 'confirmed' ,  'min:6' , 'max:15' ],
            'password_confirmation'  =>  [ 'sometimes' , 'min:6' , 'max:15' ],


            'avatar'    =>      [ 'sometimes', 'mimes:jpg,jpeg,webp,bmp,png' , 'max:5000'] ,
            'gender'    =>      [ 'sometimes', Rule::in(['female','male']) ] ,

            'birthdate '=>      [  'sometimes' ,'date' , 'date_format:Y/d/m'] ,

            'fcm_token'   =>    [ 'sometimes' ,'max:200' ] ,

            'latitude'   =>    [ 'sometimes' ,'max:50' ] ,
            'longitude'   =>    [ 'sometimes' ,'max:50' ] ,

        ];
    }
}
