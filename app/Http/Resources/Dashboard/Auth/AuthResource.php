<?php

namespace App\Http\Resources\Dashboard\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'name'           => $this->full_name,
            'email'          => $this->email,
            'email'          => $this->email,
            'permissions_array'    => $this->getAllPermissions()->pluck('name'),
            'roles_array'           => $this->roles->pluck('name')  ,
            'roles'           => RoleResource::collection($this->roles)  ,
            
            'avatar'            =>   check_image($this->avatar),
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
        ];
    }
}

