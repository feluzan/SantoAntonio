<div class="table-responsive">
    <table class="table" id="auxilios-table">
        <thead>
            <tr>
                <th>Nome (Matrícula)</th>
                <th>Refeição</th>
                <th>Valor</th>
                <th colspan="3">Ação</th>
            </tr>
        </thead>
        <tbody>
        @foreach($auxilios as $auxilio)
            <tr>
                <td>{{ $auxilio->user->name }} ({{ $auxilio->user->username}})</td>
                <td>{{ $auxilio->refeicao->nome }}</td>
                <td>{{ $auxilio->refeicao->valor }}</td>
                <td>
                    {!! Form::open(['route' => ['auxilios.destroy', $auxilio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
