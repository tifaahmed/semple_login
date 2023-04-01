<?php

namespace App\Http\Resources\Dashboard\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RoleResource extends JsonResource
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
            'name'           => $this->name,
            'permissions'           => PermissionResource::collection($this->permissions),
            'permissions_array'           => $this->permissions->pluck('name'),
        ];            

    }
}

