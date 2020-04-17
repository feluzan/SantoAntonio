<div class="table-responsive">
    <table class="table" id="user-table">
        <thead>
            <tr>
                
                <th >Ação</th>
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
                        <a href="{{ route('user.edit', [$u->id]) }}" class='btn btn-default btn-xs'>Editar</a>
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
