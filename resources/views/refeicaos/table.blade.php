<div class="table-responsive">
    <table class="table" id="refeicaos-table">
        <thead>
            <tr>
                <th>Nome</th>
        <th>Inicio</th>
        <th>Fim</th>
        <th>Valor</th>
        <th>Status</th>
        <th colspan="3">Ação</th>
            </tr>
        </thead>
        <tbody>
        @foreach($refeicaos as $refeicao)
            <tr>
                <td>{{ $refeicao->nome }}</td>
            <td>{{ $refeicao->inicio }}</td>
            <td>{{ $refeicao->fim }}</td>
            <td>{{ $refeicao->valor }}</td>
            <td>
                <?php echo ($refeicao->habilitada ? "Habilitada" : "Desabilitada"); ?>
            </td>
                <td>
                    {!! Form::open(['route' => ['refeicaos.destroy', $refeicao->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ticket.generate', [$refeicao->id]) }}" class='btn btn-default btn-xs'>Gerar Tickets</a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
