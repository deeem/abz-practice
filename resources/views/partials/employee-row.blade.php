<tr>
  <td>{{ $employee->name }}</td>
  <td>{{ $employee->position }}</td>
  <td>{{ $employee->hired->toFormattedDateString() }}</td>
  <td>{{ $employee->salary }}</td>
</tr>
