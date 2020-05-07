
@can('users.index')
    <li class="{{ Request::is('user') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}"><i class="fa fa-user"></i><span>Usuários</span></a>
    </li>
    <hr>
@endcan



@can('refeicaos.list')
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

@can('tickets.report')
    <li class="{{ Route::is('tickets.reportIndex') ? 'active' : '' }}">
        <a href="{{ route('tickets.reportIndex') }}"><i class="fa fa-edit"></i><span>Tickets por Período</span></a>
    </li>

    <li class="{{ Route::is('tickets.sumaryIndex') ? 'active' : '' }}">
        <a href="{{ route('tickets.sumaryIndex') }}"><i class="fa fa-edit"></i><span>Sumarização de Tickets</span></a>
    </li>
@endcan

