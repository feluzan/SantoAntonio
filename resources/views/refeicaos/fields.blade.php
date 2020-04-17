<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inicio', 'Inicio:') !!}
    {!! Form::text('inicio', $refeicao->inicio ?? '', ['class' => 'form-control timepicker']) !!}
</div>

<!-- Fim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fim', 'Fim:') !!}
    {!! Form::text('fim', $refeicao->fim ?? '', ['class' => 'form-control timepicker']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', $refeicao->valor ?? '', ['class' => 'form-control',
                                        'min' => '0.00',
                                        'max'=> '10000.00',
                                        'step' => '0.05', ]) !!}
</div>

<!-- Habilitada Field -->
<div class="form-group col-sm-6">
    {!! Form::label('habilitada', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::select('habilitada', array(
                                            1 => 'Habilitada',
                                            0 => 'Desabilitada')) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('refeicaos.index') }}" class="btn btn-default">Cancel</a>
</div>

<script src="{{ asset('js/doTimepicker.js') }}" defer></script>