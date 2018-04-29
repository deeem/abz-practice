<tr>
  <td>{{ $employee->name }}</td>
  <td>{{ $employee->position }}</td>
  <td>{{ $employee->hired->toFormattedDateString() }}</td>
  <td>{{ $employee->salary }}</td>
  <td><a href="{{ route('employee.show', ['id' => $employee->id]) }}" class="btn btn-outline-info btn-sm">show</a>
</tr>
