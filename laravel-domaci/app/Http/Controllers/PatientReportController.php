<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Report;
use App\Http\Resources\ReportCollection;

class PatientReportController extends Controller
{
    public function index($user_id)
    {
        $reports = Report::get()->where('patientId', $user_id);

        if (count($reports)==0)

            {return response()->json('Data not found', 404);}

        return new ReportCollection($reports);
} }
