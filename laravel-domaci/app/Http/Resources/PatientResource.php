<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'patient';

    public function toArray($request)
    {
        return [
            //'id'=> $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'age' => $this->resource->age,
            'phoneNumber' => $this->resource->phoneNumber,
        ];
    }
}
