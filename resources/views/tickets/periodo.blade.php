@extends('layouts.app')
<script src="{{ asset('js/ticketsPeriodo.js') }}" defer></script>
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Consultar Tickets Virtuais por Período</h1>
        <!-- <h1 class="pull-right">
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <h4 class="pull-left">Filtros da Consulta</h4>
                <div class="row">
                    <div class="col-xs-12">
                        {!! Form::open(['route' => 'tickets.reportBuild','id' =>'periodoForm']) !!}
                            {!! Form::label('start', 'Data Início:') !!}
                            {{ Form::date('startDate', $startDate,['id'=>'startDateInput', 'onchange' => 'onChangeFilters()']  ) }}
                            {!! Form::label('end', 'Data Fim:') !!}
                            {{ Form::date('endDate', $endDate, ['id'=>'endDateInput', 'onchange' => 'onChangeFilters()'] ) }}
                            {!! Form::label('refeicaoLabel', 'Especificar Refeição:') !!}
                            {{ Form::select('refeicao',$refeicaoOptions, $refeicaoID , ['id'=>'selectRefeicaoInput', 'onchange' => 'onChangeFilters()']) }}
                            <!-- <br> -->
                            
                            <div class='btn-group pull-right'>
                                <a href="" class="btn btn-primary " id="periodoLink">Visualizar na tela</a>
                                {!! Form::button('Exportar PDF', ['type' => 'submit', 'class' => 'btn btn-default',  'title' => 'Emitir PDF']) !!}
                            </div>
                            
                        {!! Form::close() !!}

                        
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="box box-default">
            <div class="box-body">
            <h4 class="pull-left">Tickets Virtuais emitidos entre {{ date('d/m/Y', strtotime($startDate)) }} e {{ date('d/m/Y', strtotime($endDate)) }}</h4>
            <div class="clearfix"></div>
                <div class="row">
                @foreach($tickets as $ticket)

                    @include('tickets.ticket_card')

                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

