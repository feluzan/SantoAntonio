

<!-- Submit Field -->
{!! Form::hidden('refeicao_id',$refeicao->id) !!}
{!! Form::hidden('valor', $refeicao->valor) !!}
{!! Form::hidden('emissor_id',auth()->user()->id) !!}
{!! Form::hidden('username',$assistido->username) !!}


<div class="form-group col-sm-12">
    {!! Form::submit('Confirmar Ticket Virtual', ['class' => 'btn btn-success']) !!}
</div>
