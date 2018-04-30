@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <a href="{{ route('employee.tree') }}" class="btn btn-primary btn-large active">Tree View</a>
  <a href="{{ route('employee.index') }}" class="btn btn-primary btn-large ml-2">Table View</a>
</div>
<hr>

@if ($employees->count())
  <div class="employee-list pl-5">
    @each('partials.employee', $employees, 'employee')
  </div>
@else
  @include('partials.employee-empty')
@endif

@endsection
