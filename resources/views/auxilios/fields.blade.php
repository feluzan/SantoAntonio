<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rrefeicao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rrefeicao_id', 'Rrefeicao Id:') !!}
    {!! Form::text('rrefeicao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('auxilios.index') }}" class="btn btn-default">Cancel</a>
</div>
