<table class="table table-striped">
  <tr class="no-border">
    <th> DF</th>
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
      <td>
        @if( auth::user()->is_admin )  
          <a href="{{route('admin.instructor.drives.edit',[$instructor->id,$drive->id])}}" class="edit"><i class="fa fa-pencil fa-2x"></i></a>
          {!! Form::model($drive, [
            'method' => 'DELETE',
            'route' => ['admin.instructor.drives.destroy', $instructor->id,$drive->id],
            ]) !!}
            <div class="form-group">
              <a class="delete" href="#"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
            </div>
          {!! Form::close() !!}
        @endif
      </td>
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
        @if( auth::user()->is_admin || $instructor->user->id == auth::user()->id )
        <div class="studentActions">  
          @if(auth::user()->is_admin)
          <a href="#" data-sid="{{ $hour->student->id }}" data-hid="{{$hour->id}}" class="change"><i class="fa fa-pencil fa-2x"></i></a>
          {!! Form::model($hour, [
            'method' => 'DELETE',
            'route' => ['admin.student.hours.destroy', $hour->student->id, $hour->id]]) 
          !!} 
          @endif
          {!! Form::model($hour, [
            'method' => 'DELETE',
            'route' => ['student.hours.destroy', $hour->student->id, $hour->id]]) 
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
          @if( $key !== 'old' )
            {!! Form::open( [
              'route' => ['admin.student.hours.store', 0],
            ]) !!}
            {!! Form::button('<span class="fa fa-plus"></span> Dodaj', ['type' => 'submit', 'class' => 'btn btn-primary addStudent']) !!}
            {!! Form::close() !!}
          @endif
          </td>
        @endfor    
      @endif
    </tr>
    @endforeach
  @endforeach
</table>