@extends('layouts.app-master')
@section('content')
    <div class="container">
        <h1> Departments 

        <a class="btn btn-primary" href="{{ route('employee.add') }}">Add Employee </a>
        <a class="btn btn-primary" href="{{ route('department.create') }}">Add Department </a>
        
        </h1>
        <table class="table">
            <thead>
              <tr>          
                <th scope="col">Department</th>
                <th scope="col">No Employees</th>
                <th scope="col">Total Salary</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($departments as $department)
                    <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->users_count ? $department->users_count : '0' }}</td>
                    <td>{{ $department->users_sum_salary ? $department->users_sum_salary : '0'}}</td>
      
                 
                    <td>
                      <a class="btn btn-primary" href="{{ route('department.remove', $department->id) }}">Remove Department </a>

                    </td>
                    </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection