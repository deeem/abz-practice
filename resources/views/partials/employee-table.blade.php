<div class="row justify-content-center">
  <div class="card">
    <div class="card-body">
      <a href="{{ route('employee.create') }}" class="btn btn-success">Add employee</a>
    </div>
  </div>
  @if($filters)
  <div class="card">
    <div class="card-body">
      <span class="text-success">Applied filters:</span>
      @foreach($filters as $key=>$value)
        {{ $key }} : <span class="badge badge-info">{{ $value }}</span> &nbsp;&nbsp;
      @endforeach
    </div>
  </div>
  @endif
</div>

<table class="table table-bordered table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Hired</th>
      <th>Salary</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @each('partials.employee-row', $employees, 'employee')
  </tbody>
</table>

<div class="row justify-content-center">
  {{ $employees->links() }}
</div>
