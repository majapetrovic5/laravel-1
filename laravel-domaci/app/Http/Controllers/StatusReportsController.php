<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReportCollection;
use \App\Models\Report;

class StatusReportsController extends Controller
{
    public function index($status)
    {
        $reports = Report::get()->where('patientStatus', $status);

        if (count($reports)==0)

            {return response()->json('Data not found', 404);}

        return new ReportCollection($reports);
}
}
