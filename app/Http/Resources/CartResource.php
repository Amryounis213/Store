<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id'=>$this->id ,
            'quantity'=> $this->quantity ,
            'product'=>[
                'id'=> $this->product->id,
                'name'=> $this->product->name ,
                'image'=> asset('storage/' .$this->product->image),
            ],
        ];
    }
}
