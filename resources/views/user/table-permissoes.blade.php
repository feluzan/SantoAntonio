@php

$permissoes = array(
    1 => "Alterar permissões de acesso dos usuários",
    2 => "Ver os usuários do sistema",
    3 => "Editar os usuários do sistema",
    4 => "Ver as refeições cadastradas",
    5 => "Criar e editar as refeições",
    6 => "Ver os auxílios cadastrados",
    7 => "Conceder auxílios aos usuários",
    8 => "Gerar relatórios de auxílios",
    9 => "Emitir tickets",
    10 => "Ver tickets emitidos",
    11 => "Ver resumo de uso diário (dashboard)",
    12 => "Lançar tickets passados (casos emergenciais)",
);

@endphp

<div class="table-responsive">
    <table class="table" id="user-table">
        <thead>
            <tr>
                
                <th >Descricao </th>
                <th >Status</th>
                <th> Ação </th>
            </tr>
        </thead>
        <tbody>
            @foreach(config('santoantonio.access_permission') as $aKey => $aValue)
                <tr>
                    <td>{{ $aValue['desc'] }}</td>
                    @php
                        $has = false
                    @endphp
                    @foreach($user->permissaoAcesso as $userPermissao)
                        @if($aValue['code'] == $userPermissao->codigo)
                        @php
                            $has = true
                        @endphp
                            <td>HABILITADO</td>
                            <td> 
                                <div class='btn-group'>
                                {!! Form::open(['route' => ['permissaoAcessos.destroy', $userPermissao->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title' => "Desabilitar essa permissão"]) !!}
                                {!! Form::close() !!}
                                </div>
                            </td>
                            @break
                        @endif
                        
                    @endforeach
                    @if($has == false)

                        <td>DESABILITADO</td>
                        <td> 
                            <div class='btn-group'>
                            {!! Form::open(['route' => 'permissaoAcessos.store']) !!}

                            {!! Form::hidden('user_id', $user->id) !!}
                            {!! Form::hidden('codigo', $aValue['code']) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'title' => "Habilitar essa permissão"]) !!}
                            {!! Form::close() !!}
                            </div>
                        </td>
                        @endif
                </tr>

            @endforeach

        

        </tbody>
    </table>
</div>
