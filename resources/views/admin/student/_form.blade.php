{{isset($student) ? Form::setModel($student):''}}
<div class="form-group">              
    {!! Form::label('hours_count', 'Godziny:', ['class' => 'control-label']) !!}
    {!! Form::number('hours_count', old('hours_count') , ['class' => 'form-control','min' => 1, 'max' => 128, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
</div>
<div class="form-group">              
    {!! Form::label('hours_start', 'Wykorzystane godziny:', ['class' => 'control-label']) !!}
    {!! Form::number('hours_start', old('hours_start') , ['class' => 'form-control','min' => 0, 'max' => 128, 'step' => 0.5, 'placeholder' => 'Podaj ilość wykorzystanych godzin']) !!}
</div>
<div class="form-group">              
    {!! Form::label('cost', 'Płatności:', ['class' => 'control-label']) !!}
    {!! Form::number('cost', old('cost'), ['class' => 'form-control','min' => 10, 'max' => 5000, 'step' => 10, 'placeholder' => 'Podaj cenę kursu']) !!}
</div>


{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}