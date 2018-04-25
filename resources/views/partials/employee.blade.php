<div class="employee-list-item bg-white rounded shadow">
  <p>{{ $employee->name }}, <span class="text-secondary">{{ $employee->position }}</span></p>
</div>
@if($employee->subordinates->count())
  <div class="employee-list pl-5">
    @each('partials.employee', $employee->subordinates, 'employee')
  </div>
@endif
