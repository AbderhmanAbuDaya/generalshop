<?php

namespace App\Http\Resources;

use App\Categories;
use App\Unit;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_id'=>$this->id,
            'product_title'=>$this->tag,
            'product_descrition'=>$this->tag,
            'product_unit'=>new UnitResource($this->hasUnit),
            'product_price'=>$this->price,
            'product_total'=>$this->total,
            'product_discount'=>$this->discount,
            'product_category'=>new CategoryResource(Categories::find($this->category_id)),
            'product_tags'=>TagResource::collection( $this->tags),
            'product_image'=>ImageResource::collection( $this->images),
            'product_reviews'=>ReviewResource::collection( $this->reviews),
            'product_options'=>$this->jsonOptions(),
            'status'=>200,
        ];
    }
}
