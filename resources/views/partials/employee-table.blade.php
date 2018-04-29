@isset($filters)
<div class="row justify-content-center">
  <p class="font-weight-bold">Query result &nbsp;&nbsp;</p>
  @foreach($filters as $key=>$value)
    <p>{{ $key }} : <span class="badge badge-info">{{ $value }}</span> &nbsp;&nbsp;</p>
  @endforeach
</div>
@endisset

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
