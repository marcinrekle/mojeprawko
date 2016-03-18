<a href="{{route('admin.instructor.edit',$instructor->id)}}"><i class="fa fa-pencil fa-3x"></i> Edytuj </a>
{!! Form::model($instructor, [
  'method' => 'DELETE',
  'route' => ['admin.instructor.destroy', $instructor->id]]) !!}
	<div class="form-group">
  		<a class="delete" href="#"><i class="fa fa-trash-o fa-3x text-danger"></i> Usuń </a>
  	</div>
  {{-- Form::submit('Usuń', ['class' => 'warning']) --}}
  {!! Form::close() !!}
<a href="{{route('admin.instructor.drives.create',$instructor->id)}}"><i class="fa fa-plus fa-3x"></i> Dodaj jazdę </a>