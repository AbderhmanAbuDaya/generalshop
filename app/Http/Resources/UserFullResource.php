<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'user_name'=>$this->name,
            'email'=>$this->email,
            'email_confirmed'=>$this->email_varified,
            'mobile'=>$this->mobile,
            'mobile_confirmed'=>$this->mobile_varified,
            'shipping_address'=> new AddressResource($this->shippingAddress),
            'billing_address'=> new AddressResource($this->billingAddress),
            'member_since'=>$this->created_at->format("l jS \\of  F Y")


        ];
    }
}
