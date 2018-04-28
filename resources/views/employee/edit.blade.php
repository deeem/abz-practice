@extends('layouts.app')

@section('content')

<div class="row">
  <form method="POST" action="{{ route('employee.update', ['employee' => $employee->id]) }}">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    @include('partials.validation-errors')

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
    </div>

    <div class="form-group">
      <label for="position">Position</label>
      <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}">
    </div>

    <div class="form-group">
      <label for="hired">Hired date</label>
      <input type="date" class="form-control" id="hired" name="hired" value="{{ date('Y-m-d', strtotime($employee->hired)) }}">
    </div>

    <div class="form-group">
      <label for="salary">Salary</label>
      <input type="input" class="form-control" id="salary" name="salary" value="{{ $employee->salary }}">
    </div>

    <button type="submit" class="btn btn-primary mb-2">Update employee</button>
  </form>
</div>

@endsection
