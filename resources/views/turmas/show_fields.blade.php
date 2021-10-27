<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{{ $turma->nome }}</p>
</div>

<!-- Curso Field -->
<div class="form-group">
    {!! Form::label('curso', 'Curso:') !!}
    <p>{{ $turma->curso }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $turma->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $turma->updated_at }}</p>
</div>

