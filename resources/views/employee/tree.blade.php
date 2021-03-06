@extends('layouts.app')

@section('content')

<div class="lazy-employee-list pl-5">

  <div class="lazy-employee-item bg-white rounded shadow">
    <div class="row">

      <div class="col-3">
        @if($employee->photo)
        <img class="img-thumbnail" src="{{ asset('storage/thumbs/' . $employee->photo) }}">
        @endif
      </div>

      <div class="col-7">
        <p>{{ $employee->name }}, <span class="text-secondary">{{ $employee->position }}</span></p>
      </div>

      <div class="col-2">
        <a href="{{ route('employee.show', ['id' => $employee->id]) }}" class="btn btn-outline-primary mt-1 mb-1 pl-2 pr-2">show</a>
        <a href="#" class="btn btn-outline-info lazy-employee-expand">expand</a>
      </div>

    </div>
  </div><!-- lazy-employee-item -->

</div><!-- lazy-employee-list -->

@endsection
