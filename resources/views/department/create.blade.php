@extends('layouts.app-master')
@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
    <div>{{$error}}</div>
@endforeach
@endif

<div class="container">
    <h1>Add Department</h1>
 <form method="POST"  action="{{ route('department.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter name" value="{{ old('name')}}"required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

@endsection