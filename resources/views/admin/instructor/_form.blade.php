<div class="form-group">              
    {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
    {!! Form::select('status',
    	['active' => 'Pracuje', 'end' => 'Nie pracuje'],
    	null,['placeholder' => 'Wybierz', 'class' => 'form-control','id' => 'status'])
    !!}
</div>