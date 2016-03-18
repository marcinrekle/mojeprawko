<table class="table table-striped">
  <tr>
    <th>Data</th>
    <th>Ilość</th>
    @if(Auth::user()->is_admin)<th>Edycja</th>@endif
  </tr>
    @foreach($student->hours->sortByDesc('drive.date') as $hour)
    <tr>
      <td>{{ date('Y-m-d', strtotime($hour->drive->date)) }}</td>
      <td>{{ $hour->count }}</td>
      @if(Auth::user()->is_admin)
      <td>
        <a href="{{route('admin.student.hours.edit',[$student->id,$hour->id])}}" class="edit"><i class="fa fa-pencil fa-2x"></i></a>
        {!! Form::model($hour, [
            'method' => 'DELETE',
            'route' => ['admin.student.hours.destroy', $student->id,$hour->id],
            ]) !!}
            <div class="form-group">
              <a class="delete" href="#"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
            </div>
        {!! Form::close() !!}
      </td>
      @endif
    </tr>
    @endforeach
    @if( $student->hours_start > 0)
    <tr>
      <td colspan="2">Wcześniejsze godziny</td>
      <td>{{$student->hours_start}}</td>
    </tr>
    @endif
</table>