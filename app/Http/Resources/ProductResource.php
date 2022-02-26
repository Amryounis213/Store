<?php

namespace App\Http\Resources;

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
            'id'=>$this->id ,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'image'=>asset($this->image),
            'description'=>$this->description ,
            'origin'=>'test',
            'usage'=> 'test' ,
            'natural_info'=> [
                'size'=> '250g' ,
                'calories'=>'44g',
                'protien'=>'10g' ,
                'sugar'=> '5g' ,
                'fibre'=> '2g' ,
                'fat'=> '2g' ,
                'saturated fat' => '3g',
                'vitaminA'=> '20mg',
                'vitaminC'=> '20mg' ,
            ],

        ];
    }
}
