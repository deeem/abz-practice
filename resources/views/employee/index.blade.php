@extends('layouts.app')

@section('content')
<table class="table table-bordered table-hover">
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

@endsection
