<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'role' => 'required|string|between:2,255',
            'description' => 'required|string|between:2,255',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $role = Role::create(
                    $validator->validated(),
                );
        return response()->json([
            'message' => 'Role successfully registered',
            'role' => $role
        ], 201);
    }
    public function get(){
        return Role::all();
    }
    public function getbyId($id){
        $role = Role::find($id);
        if($role != null){
            return $role;
        }else if($role == null){
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    }
    public function destroy($id){
        Role::where('id', $id)->delete();
        return response()->json([
            'message' => 'Role deleted',
        ], 202);
    }
}
