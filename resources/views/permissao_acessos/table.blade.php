<div class="table-responsive">
    <table class="table" id="permissaoAcessos-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Codigo</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($permissaoAcessos as $permissaoAcesso)
            <tr>
                <td>{{ $permissaoAcesso->user_id }}</td>
            <td>{{ $permissaoAcesso->codigo }}</td>
                <td>
                    {!! Form::open(['route' => ['permissaoAcessos.destroy', $permissaoAcesso->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('permissaoAcessos.show', [$permissaoAcesso->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('permissaoAcessos.edit', [$permissaoAcesso->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
