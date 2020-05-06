<div class="table-responsive">
    <table class="table" id="auxilios-table">
        <thead>
            <tr>
                <th>Nome (Matrícula)</th>
                <th>Auxílios</th>
                <th colspan="3">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if( !count($user->auxilio) )
                @continue
            @endif
            <tr>
                <td>{{ $user->name }} ({{ $user->username }})</td>
                <td>
                    @foreach($user->auxilio as $auxilio)

                    {{ $auxilio->refeicao->nome }} ({{ $auxilio->refeicao->getFormattedValueAttribute()}}) ||

                    @endforeach
                </td>
                <td>
                    @can('auxilio.create')
                            <a href="{{ route('auxilios.manage', [$user->id]) }}" class='btn btn-info btn-xs'>Gerenciar Auxílios </a>
                    @endcan
                </td>
                <td>
                   
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
