<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{{ $refeicao->nome }}</p>
</div>

<!-- Inicio Field -->
<div class="form-group">
    {!! Form::label('inicio', 'Inicio:') !!}
    <p>{{ $refeicao->inicio }}</p>
</div>

<!-- Fim Field -->
<div class="form-group">
    {!! Form::label('fim', 'Fim:') !!}
    <p>{{ $refeicao->fim }}</p>
</div>

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{{ $refeicao->valor }}</p>
</div>

<!-- Habilitada Field -->
<div class="form-group">
    {!! Form::label('habilitada', 'Habilitada:') !!}
    <p>{{ $refeicao->habilitada }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $refeicao->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $refeicao->updated_at }}</p>
</div>

