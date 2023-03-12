@extends('layouts.app-master')
@section('content')
    <div class="container">
        <h1> Employees 

        <a class="btn btn-primary" href="{{ route('employee.add') }}">Add Employee </a>
        <a class="btn btn-primary" href="{{ route('department.create') }}">Add Department </a>
        
        </h1>
        <table class="table">
            <thead>
              <tr>          
                <th scope="col">Department</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">image</th>
                <th scope="col">Salary</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employees as $employee)
                    <tr>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                      <img src="{{ url('/storage/uploads/') }}/{{$employee->userInfo->image}}" width="40" height="40" class="rounded-circle">
                    </td>
                    <td>{{ $employee->salary }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('employee.edit', $employee->id) }}">Edit Employee </a>

                    </td>
                    </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection