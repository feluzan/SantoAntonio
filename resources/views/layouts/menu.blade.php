<li class="{{ Route::is('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}"><i class="fa fa-home"></i><span>Dashboard</span></a>
</li>
<br>

<li class="header">Funções Básicas</li>
@can('users.index')
    <li class="{{ Route::is('users.index') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}"><i class="fa fa-user"></i><span>Listar Usuários</span></a>
    </li>
@endcan

@can('refeicaos.list')
<li class="{{ Route::is('refeicaos.index') ? 'active' : '' }}">
    <a href="{{ route('refeicaos.index') }}"><i class="fa fa-apple"></i><span>Listar Refeições</span></a>
</li>
@endcan

@can('auxilios.list')
<li class="{{ Route::is('auxilios.index') ? 'active' : '' }}">
    <a href="{{ route('auxilios.index') }}"><i class="fa fa-hand-holding-usd"></i><span>Listar Auxílios</span></a>
</li>
@endcan
<br>
@can('tickets.report')
    <li class="header">Relatórios</li>
    <li class="{{ Route::is('tickets.reportIndex') ? 'active' : '' }}">
        <a href="{{ route('tickets.reportIndex') }}"><i class="fa fa-clipboard-list"></i><span>Tickets por Período</span></a>
    </li>

    <li class="{{ Route::is('tickets.sumaryIndex') ? 'active' : '' }}">
        <a href="{{ route('tickets.sumaryIndex') }}"><i class="fa fa-file-invoice-dollar"></i><span>Sumarização de Tickets</span></a>
    </li>
@endcan

<br>
<li class="header">Funções Avançadas</li>
@can('tickets.lancamentopassado')
    <li class="{{ Route::is('tickets.lancamentopassado') ? 'active' : '' }}">
        <a href="{{ route('tickets.lancamentopassado') }}"><i class="fa fa-clipboard-list"></i><span>Lançar Tickets do Passado</span></a>
    </li>

@endcan
@can('users.editararquivados')
    <li class="{{ Route::is('users.archiveIndex') ? 'active' : '' }}">
        <a href="{{ route('users.archiveIndex') }}"><i class="fa fa-user-times"></i><span> Ver usuários arquivados</span></a>
    </li>

@endcan
<li class="{{ Request::is('turmas*') ? 'active' : '' }}">
    <a href="{{ route('turmas.index') }}"><i class="fa fa-users"></i><span>Turmas</span></a>
</li>

