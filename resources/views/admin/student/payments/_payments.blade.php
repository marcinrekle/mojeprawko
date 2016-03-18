<table class="table table-striped">
  <tr>
    <th>Data</th>
    <th>Kwota</th>
    @if(Auth::user()->is_admin)<th>Edycja</th>@endif
  </tr>
    @foreach($student->payments->sortByDesc('payment_date') as $payment)
    <tr>
      <td>{{ $payment->payment_date }}</td>
      <td>{{ $payment->amount }}</td>
      @if(Auth::user()->is_admin)
      <td>
        <a href="{{route('admin.student.payments.edit',[$student->id,$payment->id])}}" class="edit"><i class="fa fa-pencil fa-2x"></i></a>
        {!! Form::model($payment, [
            'method' => 'DELETE',
            'route' => ['admin.student.payments.destroy', $student->id,$payment->id],
            ]) !!}
            <div class="form-group">
              <a class="delete" href="#"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
            </div>
        {!! Form::close() !!}
      </td>
      @endif
    </tr>
    @endforeach
</table>