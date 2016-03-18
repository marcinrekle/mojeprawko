<div class="form-group">              
    {!! Form::label('count', 'Ilość godzin:', ['class' => 'control-label']) !!}
    {!! Form::number('count',old('count'), ['class' => 'form-control','min' => 0.5, 'max' => 3, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
</div>

{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}