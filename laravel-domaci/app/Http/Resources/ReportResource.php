<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\PatientStatusResource;

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
            'patient' => new PatientResource($this->resource->patient),
            'doctor' => new UserResource($this->resource->doctor),
            'datetime' => $this->resource->datetime,
            'report' => $this->resource->report,
            'patientStatus' => new PatientStatusResource($this->resource->patientstatus),

        ];
    }
}
