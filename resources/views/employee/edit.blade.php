@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <h3>Update employee</h3>
</div>

<div class="row justify-content-center">
  <div class="col-6">
    @if($employee->photo)
      <img src="{{ asset('storage/photos/' . $employee->photo) }}" class="card-img-top">
    @else
      <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="card-img-top">
    @endif
  </div>

  <div class="col-6">
    <form method="POST" action="{{ route('employee.update', ['employee' => $employee->id]) }}"  enctype="multipart/form-data">
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

      <div class="custom-file mb-4">
        <input type="file" class="custom-file-input" id="photo" name="photo">
        <label class="custom-file-label" for="photo">{{ isset($employee->photo) ? $employee->photo : 'Choose file...' }}</label>
      </div>

      <button type="submit" class="btn btn-primary mb-2">Update employee</button>
    </form>
  </div>
</div>

@endsection
