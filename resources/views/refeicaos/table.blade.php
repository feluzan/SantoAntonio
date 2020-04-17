<div class="table-responsive">
    <table class="table" id="refeicaos-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Inicio</th>
                <th>Fim</th>
                <th>Valor</th>
                <th>Status</th>
                <th colspan="3">Ações</th>
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
                {!! Form::model($refeicao, ['route' => ['refeicaos.update', $refeicao->id], 'method' => 'patch']) !!}
                    <div class='btn-group'>
                    @php
                        $now = Date('H:i:s');
                    @endphp
                    @if($now<$refeicao->fim)
                        @if($now>$refeicao->inicio)
                            <a href="{{ route('ticket.generate', [$refeicao->id]) }}" class='btn btn-info btn-xs' title="Gerar Tickets"><i class="glyphicon glyphicon-credit-card"></i></a>
                        @else
                        <a href="{{ route('ticket.generate', [$refeicao->id]) }}" class='btn btn-info disabled btn-xs' title="Gerar Tickets (refeição não iniciada)"><i class="glyphicon glyphicon-credit-card"></i></a>
                        @endif
                    @else
                    <a href="{{ route('ticket.generate', [$refeicao->id]) }}" class='btn btn-info disabled btn-xs' title="Gerar Tickets (refeição encerrada)"><i class="glyphicon glyphicon-credit-card"></i></a>
                    @endif

                        <a href="{{ route('refeicaos.edit', [$refeicao->id]) }}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::hidden('nome', $refeicao->nome) !!}
                        {!! Form::hidden('inicio', $refeicao->inicio) !!}
                        {!! Form::hidden('fim', $refeicao->fim) !!}
                        {!! Form::hidden('valor', $refeicao->valor) !!}
                        {!! Form::hidden('habilitada', $refeicao->habilitada ? 0 : 1) !!}
                        @if($refeicao->habilitada)
                            {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',  'title' => 'Desabilitar' ,'onclick' => "return confirm('Tem certeza? Ao desabilitar, todos os auxílios referentes a essa refeição serão cancelados.')"]) !!}
                        @else
                        {!! Form::button('<i class="glyphicon glyphicon-ok-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs',  'title' => 'Habilitar']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
