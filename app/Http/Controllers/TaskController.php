<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use Validator;

class TaskController extends Controller
{
    
    public function getAdd(){
        $tasks = Task::orderBy('id', 'desc')->get();

        return view('form.add-task', [
            'tasks' => $tasks
        ]);
    }

    public function add(Request $request){
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
        return redirect('form/add-task')->with('success', 'You have successfully added a new task...');
    }

    public function delete($id){
        Task::findOrFail($id)->delete();
        return redirect('form/add-task')->with('success', 'You successfully deleted the task...');
    }

    public function edit($id){
        $data = Task::findOrFail($id)->toArray();
        return view('form.edit-task', compact('data'));
    }

    public function update($id, Request $request){
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
        return redirect('form/add-task')->with('success', 'You changed the new task successfully...');
    }
}
