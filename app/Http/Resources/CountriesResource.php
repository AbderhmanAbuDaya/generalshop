<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountriesResource extends JsonResource
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
            'country_id'=>$this->id,
            'country_name'=>$this->name,
            'country_capital'=>$this->capital,
            'country_currency'=>$this->currency,
        ];
    }
}
