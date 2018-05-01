@extends('layouts.app')

@section('content')

<div class="row justify-content-center employee-table-search">

  <div class="card">
    <div class="card-body">

      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Oreder by
        </button>
        <div class="dropdown-menu employee-table-sort" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{ route('employee.index', ['sort' => 'name']) }}">Sort by name</a>&nbsp;&nbsp;&nbsp;
          <a class="dropdown-item" href="{{ route('employee.index', ['sort' => 'position']) }}">Sort by position</a>&nbsp;&nbsp;&nbsp;
          <a class="dropdown-item" href="{{ route('employee.index', ['sort' => 'hired']) }}">Sort by hired</a>&nbsp;&nbsp;&nbsp;
          <a class="dropdown-item" href="{{ route('employee.index', ['sort' => 'salary']) }}">Sort by salary</a>
        </div>
      </div>

    </div>
  </div>

  <div class="card">
    <div class="card-body">

      <form class="form-inline" method="GET" action="{{ route('employee.index') }}">
        <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Name">
        <input type="text" class="form-control mb-2 mr-sm-2" name="position" placeholder="Position">
        <input type="date" class="form-control mb-2 mr-sm-2" name="hired">
        <input type="text" class="form-control mb-2 mr-sm-2" name="salary" placeholder="Salary">
        <button type="submit" class="btn btn-primary mb-2">Search</button>
      </form>

    </div>
  </div>

</div>

<div class="employee-table">
  @include('partials.employee-table')
</div>

@endsection
