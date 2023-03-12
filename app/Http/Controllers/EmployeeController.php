<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use File;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retreving all department manager employees
        $employees = User::with('userInfo', 'department')
                            ->where('isManager', false)
                            ->get();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Rettiving all available department
        $departments = Department::all();

        return view('employee.create', compact('departments'));
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
            'name' => 'required|unique:users,name,',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'salary' => 'required|min:3|max:20',
            'image' => 'mimes:jpeg,png,jpg,svg,gif',
            
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute should be email.',
            'min' => 'The :attribute should be min 6 digits.',
            'max' => 'The :attribute should be max 20 digits.',
            'salary.min' => 'The :attribute should be min 3 digits.',
            'salary.max' => 'The :attribute should be max 20 max.',
            'mimes' => 'The :attribute should be type image of JPEG, PNG, etc...',
            'unique' => 'The :attribute is taken before.',
        ];

        $this->validate($request, $rules, $customMessages);

        // Storing image in public/uploads/filename.
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
      
        // Storing user 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'password' => bcrypt('password'),
            'salary' => $request->salary,
        ]);

        $user = UserInformation::create([
            'user_id' => $user->id,
            'image' => $fileName,
        ]);
        
        return redirect()->route('employee.index')->with('success', 'Employee Added successfully!');
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
        // Retriving a user given ID
        $user = User::with('userInfo')->find($id);

        return view('employee.edit', compact('user'));
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
        // Validating request.
        $rules = [
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|max:20',
            'salary' => 'required|integer:min:3,max:20',
            'image' => 'nullable|mimes:jpeg,png,jpg,svg,gif',
            'user_id' => 'required|exists:users,id',
            
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute should be email.',
            'min' => 'The :attribute should be min 6 digits.',
            'max' => 'The :attribute should be max 20 digigts.',
            'salary.min' => 'The :attribute should be min 3 digits.',
            'salary.max' => 'The :attribute should be max 20 max.',
            'mimes' => 'The :attribute should be type image of JPEG, PNG, etc...',
            'unique' => 'The :attribute is taken before.',
            'integer' => 'The :attribute must be number.'
        ];

        $this->validate($request, $rules, $customMessages);

        // Updating new image is exists
        if($request->hasFile('image')){
            // Storing image in public/uploads/filename.
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

            UserInformation::where('user_id', $request->user_id)->update([
                'image' => $fileName,
            ]);
           // Getting old image name 
            $userInfo = UserInformation::where('user_id', $request->user_id)->first();
            // Removing old image from storage is exists
            $oldImagePath = 'uploads/'. '' .$userInfo->image;
    
            if(File::exists(public_path('uploads/'))){
                File::delete(public_path('upload/test.png'));
            }
        }

        // Updating record
        User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'salary' => $request->salary,
        ]);

        // If Request contains password updated
        if($request->has('password')){
            User::where('id', $request->user_is)->update([
                'password' => bcrypt($request->password)
            ]);
        }
    
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Removing employee
        $user = User::with('userInfo')->find($id)->delete();

        return redirect()->back()->with('success', 'Employee removed successfully!');
    }

}
