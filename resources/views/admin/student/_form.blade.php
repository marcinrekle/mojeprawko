<div class="form-group">              
    {!! Form::label('hours_count', 'Godziny:', ['class' => 'control-label']) !!}
    {!! Form::number('hours_count', $student->hours_count, ['class' => 'form-control','min' => 1, 'max' => 128, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
</div>
<div class="form-group">              
    {!! Form::label('cost', 'Płatności:', ['class' => 'control-label']) !!}
    {!! Form::number('cost', $student->cost, ['class' => 'form-control','min' => 10, 'max' => 5000, 'step' => 10, 'placeholder' => 'Podaj cenę kursu']) !!}
</div>


{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}