<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    public function index(){

        // Retriving departments with its number of employees and total salaries.
        $departments = Department::withCount('users')->withSum('users', 'salary')->get();

        return view('department.index', compact('departments'));
    }
    public function create(){

        return view('department.create');
    }

    public function store(Request $request){
        // Validating request.
        $rules = [
            'name' => 'required|unique:departments,name,'
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute is taken before.',
        ];

        $this->validate($request, $rules, $customMessages);

        // /stroing record
        Department::create(['name' => $request->name]);

        return redirect()->route('employee.index')->with('success', 'Department added successfully!');
        
    }

    public function destroy($id){

        // Checking if department has emplpoyess inside so it cannot be removed
        $users = User::where('department_id', $id)->count();

        if($users > 0 ){ return redirect()->back()->with(['error' => 'Cannot be removed contains employees']);}

        // If not will be removed sucessfully 
        Department::find($id)->delete();

        return redirect()->back()->with('success', 'Department removed successfully!');

    }
}
