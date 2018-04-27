@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <p class="employee-table-sort">
    <a href="{{ route('employee', ['sort' => 'name']) }}">Sort by name</a>&nbsp;&nbsp;&nbsp;
    <a href="{{ route('employee', ['sort' => 'position']) }}">Sort by position</a>&nbsp;&nbsp;&nbsp;
    <a href="{{ route('employee', ['sort' => 'hired']) }}">Sort by hired</a>&nbsp;&nbsp;&nbsp;
    <a href="{{ route('employee', ['sort' => 'salary']) }}">Sort by salary</a>
  </p>
</div>

<div class="row justify-content-center employee-table-search">
  <form class="form-inline" method="GET" action="{{ route('employee') }}">
    <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Name">
    <input type="text" class="form-control mb-2 mr-sm-2" name="position" placeholder="Position">
    <input type="date" class="form-control mb-2 mr-sm-2" name="hired">
    <input type="text" class="form-control mb-2 mr-sm-2" name="salary" placeholder="Salary">

    <button type="submit" class="btn btn-primary mb-2">Search</button>
  </form>
</div>

@if($filters)
<div class="row justify-content-center">
  <p class="font-weight-bold">Query result &nbsp;&nbsp;</p>
  @foreach($filters as $key=>$value)
    <p>{{ $key }} : <span class="badge badge-info">{{ $value }}</span> &nbsp;&nbsp;</p>
  @endforeach
</div>
@endif

<div class="employee-table">
  @include('partials.employee-table')
</div>

@endsection
