<div class="table-responsive">
    <table class="table" id="user-table">
        <thead>
            <tr>
                
                <th >Ações</th>
                <th >Nome</th>
                <th> Usuário / Matrícula </th>
                <th> Data de Inclusão </th>
            </tr>
        </thead>
        <tbody>
        @foreach($user as $u)
            <tr>
                
                <td>
                    <div class='btn-group'>
                        @can('users.editararquivados')
                            {!! Form::open(['route' => ['users.updateArchive', $u->id], 'method' => 'post', 'style'=>'display:inline;float:left;margin-top:-1px;']) !!}
                            
                            @if($u->isArchived())
                                {!! Form::hidden('arquivado',false) !!}
                                {!! Form::button('<i class="fas fa-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs']) !!}
                            @else
                                {!! Form::hidden('arquivado',true) !!}
                                {!! Form::button('<i class="fas fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs']) !!}
                            @endif
                            

                            {!! Form::close() !!}
                        @endcan

                        @can('user.edit')
                            <a href="{{ route('user.edit', [$u->id]) }}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                        @endcan

                        @can('auxilio.create')
                            <a href="{{ route('auxilios.manage', [$u->id]) }}" class='btn btn-info btn-xs'>Gerenciar Auxílios </a>
                        @endcan
                    </div>
                </td>
                <td> {{ $u->getName() }} </td>
                <td> {{ $u->getUsername() }} </td>
                <td> {{ $u->getFormattedCreatedAtAttribute() }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
