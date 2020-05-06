

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role', 'Papel exercido no sistema:') !!}
    {!! Form::select('level', array(
        0 => 'Sem Funções',
        1 => 'Administrador',
        2 => 'Gestor do Auxílio',
        3 => 'Restaurante',
        4 => 'Consultas de Relatórios',
    )) !!}
</div>




    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
</div>
