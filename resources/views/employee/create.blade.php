@extends('layouts.app')

@section('content')

<div class="row">
  <form method="POST" action="{{ route('employee.store')}}">
    {{ csrf_field() }}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
      <label for="position">Position</label>
      <input type="text" class="form-control" id="position" name="position">
    </div>

    <div class="form-group">
      <label for="hired">Hired date</label>
      <input type="date" class="form-control" id="hired" name="hired">
    </div>

    <div class="form-group">
      <label for="salary">Salary</label>
      <input type="input" class="form-control" id="salary" name="salary">
    </div>

    <button type="submit" class="btn btn-primary mb-2">Add employee</button>
  </form>
</div>

@endsection
