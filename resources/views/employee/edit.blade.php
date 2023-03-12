@extends('layouts.app-master')
@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
    <div>{{$error}}</div>
@endforeach
@endif
<div class="container">
    <h1>Edit Employee</h1>
 <form method="POST" enctype="multipart/form-data" action="{{ route('employee.update', $user->id) }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter name" value="{{ $user->name }}"required>
          </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" >
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number "name="salary" class="form-control" id="salary" aria-describedby="salary" placeholder="Enter Salary" value="{{ $user->salary }}" required>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <img src="{{ url('/storage/uploads/') }}/{{$user->userInfo->image}}" class="rounded" alt="" width="300" height="150">
                </div>
                <div class="col-6">
                    <label for="exampleFormControlFile1"> Update Image</label>
                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                </div>
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

@endsection