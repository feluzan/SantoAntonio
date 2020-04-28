
@can('user.index')
    <li class="{{ Request::is('user') ? 'active' : '' }}">
        <a href="{{ route('user.index') }}"><i class="fa fa-user"></i><span>Usuários</span></a>
    </li>
    <hr>
@endcan



@can('refeicao.manage')
<li class="{{ Request::is('refeicaos*') ? 'active' : '' }}">
    <a href="{{ route('refeicaos.index') }}"><i class="fa fa-apple"></i><span>Refeições</span></a>
</li>
@endcan

@can('auxilios.list')
<li class="{{ Request::is('auxilios*') ? 'active' : '' }}">
    <a href="{{ route('auxilios.index') }}"><i class="fa fa-edit"></i><span>Auxilios</span></a>
</li>
@endcan


<hr>

@can('ticket.list')
    <li class="{{ Route::is('tickets.today') ? 'active' : '' }}">
        <a href="{{ route('tickets.today') }}"><i class="fa fa-edit"></i><span>Tickets de Hoje</span></a>
    </li>
    <li class="{{ Route::is('tickets.periodo') ? 'active' : '' }}">
        <a href="{{ route('tickets.periodo') }}"><i class="fa fa-edit"></i><span>Tickets por Período</span></a>
    </li>
@endcan

