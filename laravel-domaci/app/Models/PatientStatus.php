<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Report;

class PatientStatus extends Model
{
    protected $table = 'patient_status';
    public $primaryKey = 'id';

    public function report(){
        return $this->hasMany(Report::class);
    }
}
