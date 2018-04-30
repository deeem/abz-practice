<div class="employee-list-item bg-white rounded shadow">
  <div class="row">
    <div class="col-3">
      @if($employee->photo)
        <img class="img-thumbnail" src="{{ asset('storage/thumbs/' . $employee->photo) }}">
      @endif
    </div>
    <div class="col-9">
      <p>{{ $employee->name }}, <span class="text-secondary">{{ $employee->position }}</span></p>
    </div>
  </div>
</div>
@if($employee->subordinates->count())
  <div class="employee-list pl-5">
    @each('partials.employee', $employee->subordinates, 'employee')
  </div>
@endif
