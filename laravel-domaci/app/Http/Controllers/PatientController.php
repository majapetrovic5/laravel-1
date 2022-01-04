<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Patient;
use \App\Models\PatientStatus;
use \App\Models\Report;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientResource;
use Illuminate\Support\Facades\Validator;



class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PatientCollection(Patient::all());
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
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:20',
            'email' => 'required|string|max:100|email|unique:patients',
            'age' => 'required|numeric|gte:0|lte:99',
            'phoneNumber' => 'required|max:20|unique:patients',
        
        ]);

        if ($validator->fails())

            return response()->json($validator->errors());
        
            $patient = Patient::create([
                'name' => $request->name,
                'email' => $request->email,
                'age' => $request->age,
                'phoneNumber' => $request->phoneNumber,
            ]);
      
        $patient->save();
        return response()->json(['Patient is created successfully.', new PatientResource($patient)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return new PatientResource($patient);
    
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)

    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:20',
            'email' => 'required|string|max:100|email|unique:patients,email,'.$patient->id,
            'age' => 'required|numeric|gte:0|lte:99',
            'phoneNumber' => 'required|string|max:20|unique:patients,phoneNumber,'.$patient->id,
            
        ]);

        if ($validator->fails())

            return response()->json($validator->errors());
        
        //$patient->id= $request->id;
        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->age = $request->age;
        $patient->phoneNumber = $request->phoneNumber;
      
        $patient->save();
        return response()->json(['Patient is updated successfully.', new PatientResource($patient)]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
