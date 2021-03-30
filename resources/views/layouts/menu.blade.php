<li class="{{ Route::is('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}"><i class="fa fa-home"></i><span>Home/Dashboard</span></a>
</li>
<hr>

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
    <a href="{{ route('auxilios.index') }}"><i class="fa fa-hand-holding-usd"></i><span>Auxilios</span></a>
</li>
@endcan


<hr>

@can('tickets.report')
    <li class="{{ Route::is('tickets.reportIndex') ? 'active' : '' }}">
        <a href="{{ route('tickets.reportIndex') }}"><i class="fa fa-clipboard-list"></i><span>Tickets por Período</span></a>
    </li>

    <li class="{{ Route::is('tickets.sumaryIndex') ? 'active' : '' }}">
        <a href="{{ route('tickets.sumaryIndex') }}"><i class="fa fa-file-invoice-dollar"></i><span>Sumarização de Tickets</span></a>
    </li>
@endcan

<hr>

<li class="{{ Request::is('documentos*') ? 'active' : '' }}">
    <a href="{{ route('documentos.index') }}"><i class="fa fa-edit"></i><span>Biblioteca de Documentos</span></a>
</li>

