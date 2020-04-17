<div class="table-responsive">
    <table class="table" id="auxilios-table">
        <thead>
            <tr>
                <th>Refeição</th>
                <th>Valor Atual</th>
                <th>Possui Auxílio?</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($refeicoes as $refeicao)
            <tr>
                <td>{{ $refeicao->nome }}</td>
                <td>{{ $refeicao->valor }}</td>
                @php
                    $has = false
                @endphp
                @foreach($user->auxilio as $auxilio)
                    @if($auxilio->refeicao->id == $refeicao->id)
                    @php
                        $has = true
                    @endphp
                        <td>SIM</td>
                        <td> 
                            <div class='btn-group'>
                            {!! Form::open(['route' => ['auxilios.destroy', $auxilio->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                            </div>
                        </td>
                        @break
                    @endif
                    
                @endforeach
                @if($has == false)

                    <td>NÃO</td>
                    <td> 
                        <div class='btn-group'>
                        {!! Form::open(['route' => 'auxilios.store']) !!}

                        {!! Form::hidden('user_id', $user->id) !!}
                        {!! Form::hidden('refeicao_id', $refeicao->id) !!}
                        @if($refeicao->habilitada)
                            {!! Form::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'title' => "Conceder Auxílio"]) !!}
                        @else
                        {!! Form::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-success disabled btn-xs', 'title' => "Conceder Auxílio (Habilite a refeição primeiro)"]) !!}
                        @endif
                        {!! Form::close() !!}
                        </div>
                    </td>
                @endif
                
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
