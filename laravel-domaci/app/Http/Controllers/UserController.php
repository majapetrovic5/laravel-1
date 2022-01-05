<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Patient;
use \App\Models\PatientStatus;
use \App\Models\Report;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(User $doctor)
    {
        return new UserResource($doctor);
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
    public function update(Request $request, User $doctor)
    {
        if(Auth()->user()->isAdmin() || Auth()->user()->id === $doctor->id) {
       
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|max:50|email|unique:users,email,'.$doctor->id,
                'password' => 'required|string|regex:"^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"',
            ]);
    
            if ($validator->fails())
                return response()->json($validator->errors());
    
          // $user->remember_token = Str::random(10);
          $doctor->name = $request->name;
          $doctor->email = $request->email;
          $doctor->password = Hash::make($request->password);
          $doctor->email_verified_at = now();
          $doctor->save();
           return response()->json(['Successfully updated doctor', 'data' => $doctor]);
        
            //return response()->json('Successfully registered doctor.');
    
        }
        else return response()->json('Unauthorized to update other doctors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        if(Auth()->user()->isAdmin()){
        if($doctor->id != Auth()->user()->id){
            $doctor->delete();
            return response()->json('Doctor is deleted successfully.');
        }
        else return response()->json('You cannot delete admin (yourself)!');
    } 
    return response()->json('You are not authorized to delete doctors.');
}

    public function showme(){
 
          return new UserResource(Auth()->user());

    }
}
