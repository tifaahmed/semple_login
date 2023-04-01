<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword;

use App\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

// Notification
use Illuminate\Support\Facades\Notification;
use App\Notifications\ActiveEmailNotification;

use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use
        HasApiTokens ,
        HasFactory   ,
        HasRoles     ,
        SoftDeletes ,
        Notifiable
    ;

    protected $guard_name = 'sanctum';
    protected $fillable = [
        'first_name',// string
        'last_name', // string / nullable
        'user_name', // string / unique // use like id
        
        'email',  // string  /unique / nullable
        'password', // string
        
        'login_type',   // enum / 'google','facebook','normal; / default: normal
        'gender',   // enum / 'girl','boy' / default: boy
        'phone',    // string  /unique / nullable
        'birthdate', //  date  / nullable
        'email_verified_at',  // datetime   / nullable
        'phone_verified_at',  // datetime   / nullable

        'avatar', // string(file) / nullable

        'fcm_token', // string / nullable 
        'latitude', // string / nullable
        'longitude', // string / nullable

        'token', // string / nullable / unique
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $appends = [
        'full_name'
    ];

    //scope
        public function scopeRelateUser($query,$user_id){
            return $query->where('user_id',$user_id);
        }
        public function scopeRelateAuth($query){
            return $query->where('user_id',Auth::user()->id);
        }

    public function getToken( ) : array { // sanctum
        $token = $this -> createToken( ($this->remember_token ) ? ( $this->remember_token ) : ( $this->email??$this->phone  ) )  ; 
        return [
            'token_type'        =>  'Bearer' ,
            'expires_in'        =>  null ,
            'name_token'        =>  null,
            'access_token'      =>  $token ->plainTextToken ,
            'refresh_token'     =>  null ,
            'updated_at_token'  =>  null ,
            'created_at_token'  =>  null ,
        ] ; 
    }
    // public function getToken( ) : array {   // passport

    //     $token = $this -> createToken( $this->remember_token ?  $this->remember_token : '' )->accessToken;
    //     return [
    //     'token_type'        =>  'Bearer' ,
    //     'expires_in'        =>  $token -> expires_in ,
    //     'name_token'        =>  $token -> name,
    //     'access_token'      =>  $token -> token ,
    //     'refresh_token'     =>  null ,
    //     'updated_at_token'  =>  $token -> updated_at ,
    //     'created_at_token'  =>  $token -> created_at ,
    //     ] ; 
    // }


    // Notification

        public function sendActiveEmailNotification()
        {
            $data = [];
            $this->notify(new ActiveEmailNotification($data));
        }

    // Notification

    // get Attribute
        public function getFullNameAttribute(){ //full_name
            return $this->first_name . ' ' .$this->last_name;
        }
        
}
