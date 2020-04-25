@extends('layouts.app')
<script src="{{ asset('js/ticketsPeriodo.js') }}" defer></script>
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Consultar Tickets Virtuais por Período</h1>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('tickets.create') }}">Add New</a>
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <h4 class="pull-left">Período da Consulta</h4>
                <div class="row">
                    <div class="col-xs-12">
                        {!! Form::open(['route' => 'tickets.periodo','id' =>'periodoForm']) !!}
                            {!! Form::label('start', 'Data Início:') !!}
                            {{ Form::date('startDate', $startDate,['id'=>'startDateInput', 'onchange' => 'onChangeDates()']  ) }}
                            {!! Form::label('end', 'Data Fim:') !!}
                            {{ Form::date('endDate', $endDate, ['id'=>'endDateInput', 'onchange' => 'onChangeDates()'] ) }}
                            <br>
                            
                            <div class='btn-group'>
                                <a href="" class="btn btn-primary" id="periodoLink">Atualizar Peíodo</a>
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

