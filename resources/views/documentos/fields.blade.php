
<div class="form-group col-sm-12">
{!! Form::file('file') !!}
</div>



<div class="form-group col-sm-6">
{!! Form::label('Nome do arquivo') !!}
{!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
{!! Form::label('Breve descrição') !!}
{!! Form::text('descricao', null, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('user_id',auth()->user()->id) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('documentos.index') }}" class="btn btn-default">Cancel</a>
</div>
