<div class="table-responsive">
    <table class="table" id="turmas-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th>Periodo</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($turmas as $turma)
            <tr>
                <td>{{ $turma->nome }}</td>
                <td>{{ $turma->curso }}</td>
                <td>{{ $turma->periodo }}</td>

                <td>
                    {!! Form::open(['route' => ['turmas.destroy', $turma->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('turmas.show', [$turma->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('turmas.edit', [$turma->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
