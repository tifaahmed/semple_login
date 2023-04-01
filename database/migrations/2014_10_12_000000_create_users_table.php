<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('user_name')->nullable()->unique();
            
            $table->string('password');

            
            $table->enum('login_type',['google','facebook','normal'])->default('normal');
            $table->enum('gender',['female','male'])->default('male');
            $table->string('phone')->nullable()->unique();
            $table->date('birthdate')->nullable();
            
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            
            $table -> string('avatar') -> nullable( );


            $table -> string('fcm_token') -> nullable( ) ;

            $table->string('latitude')->nullable() ;
            $table->string('longitude')->nullable();

            $table->string('token', 60)-> nullable( )->unique();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
