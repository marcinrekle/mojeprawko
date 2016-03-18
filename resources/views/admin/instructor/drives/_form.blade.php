<div class="form-group">              
    {!! Form::label('date', 'Data:', ['class' => 'control-label']) !!}
    {!! Form::date('date',$data['date'], ['class' => 'form-control', 'placeholder' => 'rrrr.mm.dd']) !!}
</div>

<div class="form-group">              
    {!! Form::label('time', 'Czas:', ['class' => 'control-label']) !!}
    {!! Form::time('time',$data['time'], ['class' => 'form-control', 'placeholder' => 'gg:mm']) !!}
</div>

<div class="form-group">              
    {!! Form::label('hours_count', 'Ilość godzin:', ['class' => 'control-label']) !!}
    {!! Form::number('hours_count',old('hours_count'), ['class' => 'form-control','min' => 0.5, 'max' => 8, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
</div>


{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}