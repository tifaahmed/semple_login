<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder {

    public function run( ) {
        Role::updateOrCreate( [ 'name' => 'admin' ,'guard_name' => 'sanctum'] )  ;
        Role::updateOrCreate( [ 'name' => 'customer' ,'guard_name' => 'sanctum'] )  ;
        Role::updateOrCreate( [ 'name' => 'super admin' ,'guard_name' => 'sanctum'] )  ;
    }

}
