<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    /**
     * store
     */
    public function store(Request $request){
        $data =  $request->all();
        $rule=[
            'name'      => 'required',
        ];
        $customMessage=[
            'name.required'  => 'Department Name is required',
        ];
        $validation=Validator::make($data,$rule,$customMessage);
        if($validation->fails()){
            return response()->json($validation->errors(),422);
        }
        # authentication checked
        if(!Auth::user()){
            return response()->json(['error'=>'Unauthorized',401]);
        }

        $user_id = Auth::user()->id;
        # data insert
        $department= new Departments();
        $department->name       = $data['name'];
        $department->user_id    = $user_id;
        $department->created_at = Carbon::now();
        $department->save();
        $message = "Department added successfully";
        return response()->json(['message'=>$message],201);
    }

    /**
     * getDepartmentList
     */
    public function getDepartmentList(){
        # authentication checked
        if(!Auth::user()){
            return response()->json(['error'=>'Unauthorized',401]);
        }
        $user_id = Auth::user()->id;
        $departments=Departments::select('id','name')->where('user_id',$user_id)->get();
        return response()->json(['departments'=>$departments],200);
    }
}
