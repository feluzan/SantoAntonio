
<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome_label', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('curso_label', 'Curso:') !!}
    {!! Form::text('curso', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('periodo_label', 'Período:') !!}
    {!! Form::select('periodo', config('santoantonio.periodo')) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('turmas.index') }}" class="btn btn-default">Cancelar</a>
</div>
