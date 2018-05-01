@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-md3 ml-md-auto">
    <p class="employee-table-sort">
      <a href="{{ route('employee.index', ['sort' => 'name']) }}">Sort by name</a>&nbsp;&nbsp;&nbsp;
      <a href="{{ route('employee.index', ['sort' => 'position']) }}">Sort by position</a>&nbsp;&nbsp;&nbsp;
      <a href="{{ route('employee.index', ['sort' => 'hired']) }}">Sort by hired</a>&nbsp;&nbsp;&nbsp;
      <a href="{{ route('employee.index', ['sort' => 'salary']) }}">Sort by salary</a>
    </p>
  </div>
  <div class="col-md-3 ml-md-auto">
    <a href="{{ route('employee.create') }}" class="btn btn-success">Add employee</a>
  </div>
</div>

<div class="row justify-content-center employee-table-search">
  <form class="form-inline" method="GET" action="{{ route('employee.index') }}">
    <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Name">
    <input type="text" class="form-control mb-2 mr-sm-2" name="position" placeholder="Position">
    <input type="date" class="form-control mb-2 mr-sm-2" name="hired">
    <input type="text" class="form-control mb-2 mr-sm-2" name="salary" placeholder="Salary">

    <button type="submit" class="btn btn-primary mb-2">Search</button>
  </form>
</div>


<div class="employee-table">
  @include('partials.employee-table')
</div>

@endsection
