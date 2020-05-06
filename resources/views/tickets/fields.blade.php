

<!-- Submit Field -->
{!! Form::hidden('refeicao_id',$refeicao->id) !!}
{!! Form::hidden('valor', $refeicao->valor) !!}
{!! Form::hidden('emissor_id',auth()->user()->id) !!}





<div class="form-group col-sm-6">
    {!! Form::label('username', 'Usuário/Matrícula:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Gerar Ticket Virtual', ['class' => 'btn btn-success']) !!}
</div>
