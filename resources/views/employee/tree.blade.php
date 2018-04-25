@extends('layouts.app')

@section('content')

@if ($employees->count())
  <div class="employee-list pl-5">
    @each('partials.employee', $employees, 'employee')
  </div>
@else
  @include('partials.employee-empty')
@endif

@endsection
