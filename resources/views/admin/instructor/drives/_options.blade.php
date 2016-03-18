<a href="{{route('admin.instructor.edit',$instructor->id)}}">Edytuj</a>
{!! Form::model($instructor, [
  'method' => 'DELETE',
  'route' => ['admin.instructor.destroy', $instructor->id]]) !!}
  {!! Form::submit('Usuń', ['class' => 'warning']) !!}
  {!! Form::close() !!}
<a href="{{route('admin.instructor.create',$instructor->id)}}">Dodaj jazdę - url</a>