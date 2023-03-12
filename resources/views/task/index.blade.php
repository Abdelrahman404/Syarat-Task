@extends('layouts.app-master')
@section('content')
    <div class="container">
        <h1> Tasks 

        <a class="btn btn-primary" href="{{ route('task.create') }}">Add Task </a> 
        </h1>
        <table class="table">
            <thead>
              <tr>          
                <th scope="col">Employee</th>
                <th scope="col">Department</th>
                <th scope="col">Description</th>
                <th scope="col">Response</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
                    <tr>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->user->department->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->response }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('task.remove', $task->id) }}">Remove!</a>
                    </td>
                    </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection