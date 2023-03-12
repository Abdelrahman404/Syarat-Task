@extends('layouts.app-master')
@section('content')
    <div class="container">
        <h1>MY Tasks</h1>
        <div class="row">
            @foreach ($tasks as $task)
                <div class="col-12">
                    <form action="{{ route('task.submit') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card" style="width: 60rem;">
                            <div class="card-body">
                            <h5 class="card-title">
                                Status : <span class="badge badge-success">{{ $task->status }}</span>
                            </h5>
                            <p class="card-text">{{ $task->description }}</p>
                            <div class="form-group">
                                <input type="hidden" name="task" value=" {{ $task->id }}">
                                <label for="exampleFormControlTextarea1">Response</label>
                            <textarea name="response" class="form-control" id="exampleFormControlTextarea1" placeholder="Place your response here .." rows="3" required>{{ $task->response }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit response</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

    </div>
@endsection