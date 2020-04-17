<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $auxilio->user_id }}</p>
</div>

<!-- Refeicao Id Field -->
<div class="form-group">
    {!! Form::label('refeicao_id', 'refeicao Id:') !!}
    <p>{{ $auxilio->refeicao_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $auxilio->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $auxilio->updated_at }}</p>
</div>

