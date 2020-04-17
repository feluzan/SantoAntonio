<div class="table-responsive">
    <table class="table" id="auxilios-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Rrefeicao Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($auxilios as $auxilio)
            <tr>
                <td>{{ $auxilio->user_id }}</td>
            <td>{{ $auxilio->rrefeicao_id }}</td>
                <td>
                    {!! Form::open(['route' => ['auxilios.destroy', $auxilio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('auxilios.show', [$auxilio->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('auxilios.edit', [$auxilio->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
