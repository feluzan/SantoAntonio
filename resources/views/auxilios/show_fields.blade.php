<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $auxilio->user_id }}</p>
</div>

<!-- Rrefeicao Id Field -->
<div class="form-group">
    {!! Form::label('rrefeicao_id', 'Rrefeicao Id:') !!}
    <p>{{ $auxilio->rrefeicao_id }}</p>
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

