<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\User;
use \App\Models\Patient;
use \App\Models\PatientStatus;

class Report extends Model
{
    protected $table = 'reports';
    public $primaryKey='id';

    protected $fillable = [
        'patientId',
        'doctorId',
        'datetime',
        'report',
        'patientStatus',
    ];
 
    public function patient(){
        return $this->belongsTo(Patient::class, 'patientId');
    }

    public function patientstatus(){
        return $this->belongsTo(PatientStatus::class, 'patientStatus');
    }

    public function doctor(){
        return $this->belongsTo(User::class,'doctorId');
    }

}
