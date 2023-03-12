@extends('layouts.app-master')
@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
    <div>{{$error}}</div>
@endforeach
@endif
<div class="container">
    <h1>Assign Task</h1>
 <form method="POST"  action="{{ route('task.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="salary">Employee</label>
         
                <select class="js-example-basic-single" name="employee" style="width: 50%" required>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"> {{ $employee->name }}</option>
                    @endforeach
                </select>    
            </select>

          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

<script>

    
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });


</script>
@endsection