<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Hash;
use Auth;
use App\User;
use Validator; 
use App\Task;

class ApiController extends Controller
{
    public function postLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect() -> back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $auth = array(
            'email' => $request->email,
            'password' => $request->password
        );

        try {
            if (!$token = JWTAuth::attempt($auth)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getLogout(Request $request)
    {
        // $this->validate($request, [
        //     'token' => 'required'
        // ]);
        // JWTAuth::invalidate($request->input('token'));
        // $validator = Validator::make($request->all(), [
        //     'token' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect() -> back()
        //         ->withInput()
        //         ->withErrors($validator->errors());
        // }

        Auth::logout();

        return response()->json([
            'status' => 'ok',
            'message' => 'User logout successfully',
        ]);
    }

    public function addTask(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks,name|max:255',
        ]);

        if ($validator->fails()) {
            return redirect() -> back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $data = new Task();
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'You have successfully added a new task...'
        ]);
    }

    public function editTask($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks,name|max:255',
        ]);

        if ($validator->fails()) {
            return redirect() -> back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $data = Task::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'You changed the new task successfully...'
        ]);
    }

    public function deteleTask($id){
        Task::findOrFail($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'You successfully deleted the task...'
        ]);
    }
}
