<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'image' => $this->image,
            'role' => Role::where('id', $this->role_id)->first()->name,
            'default_address_id' => $this->default_address_id,
            'addresses' => Address::where('user_id', $this->id)->latest()->get(),
        ];
    }
}
