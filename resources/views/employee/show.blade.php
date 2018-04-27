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
<div class="row justify-content-center">
  <div class="col-3">
    <a class="btn btn-outline-info" href="{{ route('employee.edit', ['employee' => $employee->id]) }}">&nbsp;&nbsp;edit&nbsp;&nbsp;</a>
    <form action="{{ route('employee.destroy', ['employee' => $employee->id]) }}" method="POST" style="display:inline">
      {{ method_field('DELETE') }}
      {{ csrf_field() }}
      <button type="submit" class="btn btn-outline-danger" onclick="return confirm('are you shure?')">delete</button>
    </form>
  </div>
</div>
@endsection
