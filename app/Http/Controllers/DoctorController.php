<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'strNumber' => 'required|string|between:2,255',
            'birthDate' => 'required|string|date',
            'address' => 'required|string|between:2,255',
            'specialization' => 'required|string|between:2,255',
            'practicePlace' => 'required|string|between:2,255',
            'note' => 'required|string|between:2,255',
            'user_id' => 'required|integer|between:0,1',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $doctor = Doctor::create(
                    $validator->validated(),
                );
        return response()->json([
            'message' => 'Doctor successfully registered',
            'doctor' => $doctor
        ], 201);
    }
    public function get(){
        return Doctor::all();

    }
    public function getbyId($id){
        if($id){
            $doctor = User::with(['doctor'])->find($id);
        }
        return response()->json([
            'data' => $doctor
        ], 200);
        // $doctor = Doctor::find($id);
        // if($doctor != null){
        //     return $doctor;
        // }else if($doctor == null){
        //     return response()->json([
        //         'message' => 'Data not found'
        //     ], 404);
        // }
    }
    public function destroy($id){
        Doctor::where('id', $id)->delete();
        return response()->json([
            'message' => 'Doctor deleted',
        ], 202);
    }
}
