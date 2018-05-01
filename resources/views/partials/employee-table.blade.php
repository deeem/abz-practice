@if($filters)
  <div class="row justify-content-center mt-4">
    <div class="alert alert-warning">
        <span class="text-success">Applied filters:</span>
        @foreach($filters as $key=>$value)
          {{ $key }} : <span class="badge badge-info">{{ $value }}</span> &nbsp;&nbsp;
        @endforeach
        <a href="{{ route('employee.index') }}" class="btn btn-info btn-danger">Clear</a>
    </div>
  </div>
@endif

<table class="table table-bordered table-hover mt-4">
  <thead class="thead-light">
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Hired</th>
      <th>Salary</th>
      <th>
        <a href="{{ route('employee.create') }}" class="btn btn-success">Add</a>
      </th>
    </tr>
  </thead>
  <tbody>
    @each('partials.employee-row', $employees, 'employee')
  </tbody>
</table>

<div class="row justify-content-center">
  {{ $employees->links() }}
</div>
