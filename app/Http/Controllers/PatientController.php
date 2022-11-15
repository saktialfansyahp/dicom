<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'medicalRecordNumber' => 'required|string|between:2,255',
            'name' => 'required|string|between:2,255',
            'birth_date' => 'required|string|date',
            'gender' => 'required|string|between:2,20',
            'phoneNumber' => 'required|string|between:2,255',
            'email' => 'required|string|between:2,255',
            'address' => 'required|string|between:2,255',
            'disease' => 'required|string|between:2,255',
            'note' => 'required|string|between:2,255',
            'id_user' => 'required|integer|between:0,1',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $patient = Patient::create(
                    $validator->validated(),
                );
        return response()->json([
            'message' => 'Patient successfully registered',
            'patient' => $patient
        ], 201);
    }
    public function getpatient(){
        $patient = Patient::all();
        return response()->json(['patient' => $patient], 200);
    }
    public function destroy($id){
        Patient::where('id', $id)->delete();
        return response()->json(['message' => 'Patient deleted']);
    }
}
