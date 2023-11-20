<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id'=>$this->id,
            'name'=>$this->description,
            'created_at'=>$this->created_at?->format('d-m-Y'),
            'updated_at'=>$this->updated_at?->format('d-m-Y'),
        ];

        // return[
        //     'id'=>$this->id,
        //     'name'=>$this->name,
        //     'description'=>$this->description,
        //     'created_at'=>$this?->created_at?->format('d-m-Y'),
        //     'updated_at'=>$this?->updated_at?->format('d-m-Y'),
        // ];

    }
}
