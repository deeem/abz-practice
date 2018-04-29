@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-6">
    <h3>Update employee</h3>
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

      <div class="form-group">
        <select class="employee-form-superviser form-control" name="superviser">
          @isset($employee->superviser)
          <option value="{{ $employee->superviser->id }}">{{ $employee->superviser->name }}</option>
          @endisset
        </select>
      </div>

      <button type="submit" class="btn btn-primary mb-2">Update employee</button>
    </form>
  </div>
</div>

@endsection
