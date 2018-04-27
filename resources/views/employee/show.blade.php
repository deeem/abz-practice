@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-6">
    <h2>{{ $employee->name }}</h2>
    <p><span class="font-weight-bold">Position</span> {{ $employee->position }}</p>
    <p><span class="font-weight-bold">Hired date</span> {{ $employee->hired->toFormattedDateString() }}</p>
    <p><span class="font-weight-bold">Salary</span> {{ $employee->salary }}</p>
  </div>
</div>
@endsection
