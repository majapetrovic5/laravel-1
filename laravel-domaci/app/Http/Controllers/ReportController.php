<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Patient;
use \App\Models\PatientStatus;
use \App\Models\Report;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\ReportResource;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ReportCollection(Report::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth()->user()->isUser()) {

        $validator = Validator::make($request->all(), [

            'patientId' => 'required|numeric|gte:1|lte:7',
           // 'doctorId' => 'required|numeric|digits_between:1,5',
            'datetime' => 'required|string|date',
            'report' => 'required|min:20',
            'patientStatus' => 'required|digits:1|numeric|gte:1|lte:5',
        
        ]);

        if ($validator->fails())

            return response()->json($validator->errors());
        
            $report = Report::create([
                'patientId' => $request->patientId,
                'doctorId' => Auth()->user()->id,
                'datetime' => $request->datetime,
                'report' => $request->report,
                'patientStatus' => $request->patientStatus,
            ]);
      
        $report->save();
        return response()->json(['Report is created successfully.', new ReportResource($report)]);
    } 
    else return response()->json('Unauthorized to create reports.');

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return new ReportResource($report);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        if(Auth()->user()->isUser()) {

            if(Auth()->user()->id == $report->doctorId){
       
                $validator = Validator::make($request->all(), [

            'patientId' => 'required|numeric|gte:1|lte:5',
            //'doctorId' => 'required|numeric|digits_between:1,5',
            'datetime' => 'required|string|date',
            'report' => 'required|min:20',
            'patientStatus' => 'required|digits:1|numeric|gte:1|lte:5',
            
        ]);

        if ($validator->fails())

            return response()->json($validator->errors());
        
        //$patient->id= $request->id;
        $report->patientId = $request->patientId;
        $report->doctorId = Auth()->user()->id;
        $report->datetime = $request->datetime;
        $report->report = $request->report;
        $report->patientStatus = $request->patientStatus;
      
        $report->save();
        return response()->json(['Report is updated successfully.', new ReportResource($report)]);
    }
    else return response()->json('Unauthorized to update someone elses reports.');
} 
    else return response()->json('Unauthorized to update reports.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    { 

        if(Auth()->user()->isUser()) {
            if(Auth()->user()->id == $report->doctorId){
            $report->delete();
        return response()->json('Report is deleted successfully.'); }
        else response()->json('Unauthorized to delete someone elses reports.');

            }
            else response()->json('Unauthorized to delete reports.');
    }


    public function showmyreports()
    { 
        if(Auth()->user()->isUser()) {
       
            $reports = Report::get()->where('doctorId', Auth()->user()->id);

            if (count($reports) ==0 )
    
                return response()->json('Data not found', 404);
                
    
            return new ReportCollection($reports);


        } else return response()->json('You are not allowed to have reports.');
    }
}
