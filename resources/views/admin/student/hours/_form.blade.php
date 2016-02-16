<div class="form-group">              
    {!! Form::label('drive_date', 'Data:', ['class' => 'control-label']) !!}
    {!! Form::date('drive_date',old('drive_date'), ['class' => 'form-control', 'placeholder' => 'Podaj date jazdy']) !!}
</div>

<div class="form-group">              
    {!! Form::label('count', 'Ilość:', ['class' => 'control-label']) !!}
    {!! Form::number('count',old('count'), ['class' => 'form-control','min' => 0.5, 'max' => 2, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
</div>

<div class="form-group">              
    {!! Form::label('instructor_id', 'Instruktor:', ['class' => 'control-label']) !!}
    {!! Form::select('instructor_id', $instructors, old('instructor_id'), ['class' => 'form-control', 'placeholder' => 'Wybierz instruktora'] ) !!}
</div>

{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}