@if ($employees->count())
  <ul>
    @each('partials.employee', $employees, 'employee')
  <ul>
@else
  @include('partials.employee-empty')
@endif
