<a href="{{route('admin.student.edit',[$student->id])}}" class="edit"><i class="fa fa-pencil fa-2x"></i></a>
{!! Form::model($student, [
    'method' => 'DELETE',
    'route' => ['admin.student.destroy', $student->id],
    ]) !!}
    <div class="form-group">
      <a class="delete" href="#"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
    </div>
{!! Form::close() !!}
<a href="{{route('admin.student.hours.create',$student->id)}}" class="" title="Dodaj jazdę"><i class="fa fa-car fa-2x"></i></a>
<a href="{{route('admin.student.payments.create',$student->id)}}" title="Dodaj wpłatę"><i class="fa fa-money fa-2x"></i></a>