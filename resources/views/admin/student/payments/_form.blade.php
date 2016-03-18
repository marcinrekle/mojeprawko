<div class="form-group">              
    {!! Form::label('payment_date', 'Data:', ['class' => 'control-label']) !!}
    {!! Form::date('payment_date',old('drive_date'), ['class' => 'form-control', 'placeholder' => 'rrrr.mm.dd']) !!}
</div>

<div class="form-group">              
    {!! Form::label('amount', 'Kwota:', ['class' => 'control-label']) !!}
    {!! Form::number('amount',old('count'), ['class' => 'form-control','min' => 10, 'max' => 5000, 'step' => 10, 'placeholder' => 'Podaj kwotę wpłaty']) !!}
</div>

{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}