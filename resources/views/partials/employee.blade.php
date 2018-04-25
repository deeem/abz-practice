<li>{{ $employee->name }}, {{ $employee->position }}</li>
@if($employee->subordinates->count())
  <ul>
    @each('partials.employee', $employee->subordinates, 'employee')
  </ul>
@endif
