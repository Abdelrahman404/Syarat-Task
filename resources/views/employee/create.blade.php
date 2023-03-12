@extends('layouts.app-master')
@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
    <div>{{$error}}</div>
@endforeach
@endif
<div class="container">
    <h1>Add Employee</h1>
 <form method="POST" enctype="multipart/form-data" action="{{ route('employee.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email')}}" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter name" value="{{ old('name')}}"required>
          </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label for="salary">Salary</label>
              <input type="number "name="salary" class="form-control" id="salary" aria-describedby="salary" placeholder="Enter Salary" value="{{ old('salary')}}" required>
            </div>
            <div class="col-6">
              <label for="salary">Department</label>
              <select class="custom-select" name="department_id" required>
                @foreach ($departments as $department)
                  <option value="{{ $department->id }}"> {{ $department->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection