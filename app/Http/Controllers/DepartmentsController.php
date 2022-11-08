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

    /**
     * details function
     * @param $request $department_id;
     * @return Json array;
     */
    public function details(Request $request){
        # authorization checked
        if(!Auth::user()){
            return response()->json(['error'=>'Unauthorized',401]);
        }
        $user_id = Auth::user()->id;
        # get department details
        $department = Departments::select('id','name')->where('user_id',$user_id)->find($request->department_id);
        return response()->json(['department'=>$department],200);
    }

    /**
     * edit function
     * @param $request $department_id;
     * @return Json array;
     */
    public function edit(Request $request){
        # authorization checked
        if(!Auth::user()){
            return response()->json(['error'=>'Unauthorized',401]);
        }
        $user_id = Auth::user()->id;
        # department details
        $department = Departments::select('id','name')->where('user_id',$user_id)->find($request->department_id);
        return response()->json(['department'=>$department],200);
    }

    /**
     * update function
     * @param $request $edit_id, $name;
     * @return Json array;
     */
    public function update(Request $request){
        $data =  $request->all();
        $rule=[
            'edit_id'   => 'required',
            'name'      => 'required',
        ];
        $customMessage=[
            'edit_id.required'  => 'Edit id required.',
            'name.required'     => 'Department Name is required.',
        ];
        $validation=Validator::make($data,$rule,$customMessage);
        if($validation->fails()){
            return response()->json($validation->errors(),422);
        }

        # authorization checked
        if(!Auth::user()){
            return response()->json(['error'=>'Unauthorized',401]);
        }
        $user_id = Auth::user()->id;
        $edit_id = $request->edit_id;
        $department = Departments::where('id',$edit_id)->where('user_id',$user_id)->count();
        if($department){
            $result=Departments::where('id',$edit_id)->update(['name'=>$data['name'], 'updated_at'=>Carbon::now()]);
            if($result)
                return response()->json(['message'=>'Updated Successfully.'],202);
            else
                return response()->json(['message'=>'Fail.'],422);
        }
        else
            return response()->json(['message'=>'Department not found.'],404);
    }
}
