<table class="table table-striped">
  <tr class="no-border">
    <th>Data</th>
    <th>1</th>
    <th>2</th>
  </tr>
  @if( isset(Auth::user()->payments) )
    {{Auth::user()->hours}}
    <br />
    {{Auth::user()->payments}}
  @endif
  @foreach($instructor->drives as $key => $drives)
    @foreach($drives as $drive)
    <tr data-did="{{ $drive->id }}" data-week="{{ $key }}">
      <td>{{ date('Y-m-d', strtotime($drive->date)) }}</td>
      @foreach($drive->hours as $hour)
      <td data-hid="{{$hour->id}}" data-sid="{{ $hour->student->id }}" data-week="{{ $key }}">
        <img src="{{ $hour->student->user->avatar }}" class="img-responsive img-circle avatar avatar-small" />
        <span>
        @if(auth::user()->is_admin)
          <a href="{{route('admin.student.show',$hour->student->id)}} ">{{ $hour->student->user->name }}</a>
        @else
          {{ $hour->student->user->name }}
        @endif
        </span>
        @if( auth::user()->is_admin || $hour->student->id == $student->id )
        <div class="studentActions">  
          @if(auth::user()->is_admin)
          {!! Form::model($hour, [
            'method' => 'DELETE',
            'route' => ['admin.student.hours.destroy', $hour->student->id, $hour->id]]) 
          !!} 
          @endif
          {!! Form::model($hour, [
            'method' => 'DELETE',
            'route' => ['student.hours.destroy', $student->id, $hour->id]]) 
          !!}
          <div class="form-group">
            <a class="deleteStudent" href="#"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
          </div>
          {!! Form::close() !!}
        </div>
        @endif
      </td>
      @endforeach
      @if( count($drive->hours) < 2 )
        @for ($i = count($drive->hours); $i < 2; $i++)
          <td>
            @if( $studentCanDrive[$key] < $student->dpwCount && $drive->date > date('Y-m-d', strtotime('tomorrow')) && $drive->hours->pluck('student.id')->search($student->id) === false )
              @if( auth::user()->is_admin )        
              {!! Form::open( [
                'route' => ['admin.student.hours.store', $student->id],
              ]) !!}
              {!! Form::hidden('drive_id', $drive->id) !!}
              {!! Form::button('<span class="fa fa-plus"></span> Dodaj', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
              {!! Form::close() !!}
              @else
              {!! Form::open( [
                'route' => ['student.hours.store', $student->id],
              ]) !!}
              {!! Form::hidden('drive_id', $drive->id) !!}
              {!! Form::button('<span class="fa fa-plus"></span> Zarezerwuj', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
              {!! Form::close() !!}
              @endif
            @endif
          </td>
        @endfor    
      @endif
    </tr>
    @endforeach
  @endforeach
</table>