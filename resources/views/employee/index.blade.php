@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <p>
    <a href="{{ route('employee', ['sort' => 'name']) }}">Sort by name</a>&nbsp;&nbsp;&nbsp;
    <a href="{{ route('employee', ['sort' => 'position']) }}">Sort by position</a>&nbsp;&nbsp;&nbsp;
    <a href="{{ route('employee', ['sort' => 'hired']) }}">Sort by hired</a>&nbsp;&nbsp;&nbsp;
    <a href="{{ route('employee', ['sort' => 'salary']) }}">Sort by salary</a>
  </p>
</div>

<div class="row justify-content-center">
  <form class="form-inline" method="GET" action="{{ route('employee') }}">
    <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Name">
    <input type="text" class="form-control mb-2 mr-sm-2" name="position" placeholder="Position">
    <input type="text" class="form-control mb-2 mr-sm-2" name="salary" placeholder="Salary">

    <button type="submit" class="btn btn-primary mb-2">Search</button>
  </form>
</div>

<table class="table table-bordered table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Hired</th>
      <th>Salary</th>
    </tr>
  </thead>
  <tbody>
    @each('partials.employee-row', $employees, 'employee')
  </tbody>
</table>

<div class="row justify-content-center">
  {{ $employees->links() }}
</div>
@endsection
