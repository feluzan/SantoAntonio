<li class="{{ Request::is('user') ? 'active' : '' }}">
    <a href="{{ route('user.index') }}"><i class="fa fa-edit"></i><span>Usuários do Sistema</span></a>
</li>


<hr>


<li class="{{ Request::is('refeicaos*') ? 'active' : '' }}">
    <a href="{{ route('refeicaos.index') }}"><i class="fa fa-edit"></i><span>Refeições</span></a>
</li>

<li class="{{ Request::is('tickets*') ? 'active' : '' }}">
    <a href="{{ route('tickets.index') }}"><i class="fa fa-edit"></i><span>Tickets</span></a>
</li>

<li class="{{ Request::is('auxilios*') ? 'active' : '' }}">
    <a href="{{ route('auxilios.index') }}"><i class="fa fa-edit"></i><span>Auxilios</span></a>
</li>

