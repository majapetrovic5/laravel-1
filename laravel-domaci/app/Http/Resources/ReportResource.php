<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'report';
    public function toArray($request)
    {
        return [
            'patientId' => $this->resource->patientId,
            'doctorId' => $this->resource->doctorId,
            'datetime' => $this->resource->datetime,
            'report' => $this->resource->report,
            'patientStatus' => $this->resource->patientStatus,

        ];
    }
}
