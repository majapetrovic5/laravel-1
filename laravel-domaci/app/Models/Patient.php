<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Report;

class Patient extends Model
{
    use HasFactory;
    protected $table='patients';
    public $primaryKey='id';
   
    protected $fillable = [
        'name',
        'email',
        'age',
        'phoneNumber',
    ];



    public function report(){
        return $this->hasMany(Report::class);
    }
}
