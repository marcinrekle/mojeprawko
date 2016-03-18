<div class="form-group">              
    {!! Form::label('name', 'Imię i Nazwisko:', ['class' => 'control-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control','placeholder' => 'Podaj imię i Nazwisko']) !!}
</div>
<div class="form-group">              
    {!! Form::label('email', 'Adres E-mail:', ['class' => 'control-label']) !!}
    {!! Form::email('email', old('email'), ['class' => 'form-control','placeholder' => 'Podaj adres E-mail']) !!}
</div>
<div class="form-group">              
    {!! Form::label('password', 'Hasło:', ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Wpisz hasło zawierające min 6 znaków']) !!}
</div>
