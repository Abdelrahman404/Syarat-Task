<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Reteriving all tasks with its employees
        $tasks = Task::with('user.department')->latest()->get();

        return view('task.index', compact('tasks'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Reterving all employees 
        $employees = User::where('isManager', false)->get();

        return view('task.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating request.
        $rules = [
            'description' => 'required|min:5|max:500',
            'employee' => 'required'
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'min' => 'The :attribute should be min 5 characters.',
            'max' => 'The :attribute should be max 500 characters.'
        ];

        $this->validate($request, $rules, $customMessages);

        // /stroing record
        Task::create([
            'description' => $request->description,
            'user_id' => $request->employee,
            'status' => 'Pending'
            ]);

        return redirect()->route('task.index')->with('success', 'Task Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();

        return redirect()->route('task.index')->with('success', 'Task removed successfully!');
    }
    
}
