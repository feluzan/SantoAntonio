<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Refeicao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('refeicao_id', 'refeicao Id:') !!}
    {!! Form::text('refeicao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('auxilios.index') }}" class="btn btn-default">Cancel</a>
</div>
