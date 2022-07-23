<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapsClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     "type" => "Feature",
        //     "properties" => $this[0]->registration,
        //     "geometry" => [
        //         "type" => "polygon",
        //         "coordinates" => '' //$this->coordinates['data']
        //     ]
        // ];
    }
}
