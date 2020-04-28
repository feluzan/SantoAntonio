<div class="table-responsive">
    <table class="table" id="user-table">
        <thead>
            <tr>
                
                <th >Ações</th>
                <th >Nome</th>
                <th> Usuário / Matrícula </th>
                <th> Função </th>
                <th> Data de Inclusão </th>
            </tr>
        </thead>
        <tbody>
        @foreach($user as $u)
            <tr>
                
                <td>
                    <div class='btn-group'>
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
                <td> {{ $u->getLevelDescription() }}
                <td> {{ $u->getFormattedCreatedAtAttribute() }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
