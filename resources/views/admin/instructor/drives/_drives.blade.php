<table class="table table-striped">
  <tr>
    <th> </th>
    <th>Data</th>
    <th>1</th>
    <th>2</th>
  </tr>
      @if( isset(Auth::user()->payments) )
        {{Auth::user()->hours}}
        <br />
        {{Auth::user()->payments}}
      @endif

    @foreach($instructor->drives->sortByDesc('date') as $key => $drive)
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
      <td data-hid="{{$hour->id}}" data-sid="{{ $hour->student->id }}">
        <img src="{{ $hour->student->user->avatar }}" />
        <span><a href="{{route('admin.student.show',$hour->student->id)}}">{{ $hour->student->user->name }}</a></span>
          @if( auth::user()->is_admin )
          <div class="studentActions">  
            <a href="#" data-sid="{{ $hour->student->id }}" data-hid="{{$hour->id}}" class="change"><i class="fa fa-pencil fa-2x"></i></a>
            
            {!! Form::model($hour, [
              'method' => 'DELETE',
              'route' => ['admin.student.hours.destroy', $hour->student->id, $hour->id]]) 
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
        @for ($i = 2; $i > count($drive->hours); $i--)
        @if( $drive->date > date('Y-m-d', strtotime('tomorrow')))

        <td>
          @if(! auth::user()->is_admin )        
            <a href="#" class="add btn btn-primary"><span class="fa fa-plus"></span> Zapisz się</a>
          @else
            <a data-did="{{$drive->id}}" href="/admin/drives/{{$drive->id}}/student/" class="add btn btn-primary"><span class="fa fa-plus"></span> Dodaj</a>
          @endif
        </td>
        @else
          <td></td>
        @endif  

        @endfor
        @endif
    </tr>
    @endforeach
</table>