@extends('layouts.app')
<script src="{{ asset('js/ticketsPeriodo.js') }}" defer></script>
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Sumarização Tickets Virtuais por Período</h1>
        <!-- <h1 class="pull-right">
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <h4 class="pull-left">Informações sobre esse relatório</h4>
                <div class="row">
                    <div class="col-xs-12">
                        <p>
                            Exibe uma lista com o nome de todos os usuários que consumiram pelo menos uma refeição dentro do período solicitado. Cada coluna representa o valor total em tickets de cada usuário em um determinado dia.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <h4 class="pull-left">Filtros do Sumário</h4>
                <div class="row">
                    <div class="col-xs-12">
                        {!! Form::open(['route' => 'tickets.sumaryBuild','id' =>'periodoForm']) !!}
                            {!! Form::label('start', 'Data Início:') !!}
                            {{ Form::date('startDate', $startDate,['id'=>'startDateInput', 'onchange' => 'onChangeFilters()']  ) }}
                            {!! Form::label('end', 'Data Fim:') !!}
                            {{ Form::date('endDate', $endDate, ['id'=>'endDateInput', 'onchange' => 'onChangeFilters()'] ) }}
                            <!-- <br> -->
                            
                            <div class='btn-group pull-right'>
                                {!! Form::button('Exportar <i class="far fa-file-pdf"></i>', ['type' => 'submit', 'class' => 'btn btn-default',  'title' => 'Emitir PDF']) !!}
                            </div>
                            
                        {!! Form::close() !!}

                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h5>Preenchimentos Rápidos</h5>
                        {{ Form::button('Hoje', ['class' => 'btn vtn-default', 'onclick' => 'fastFilterToday()']) }}
                        {{ Form::button('Ontem', ['class' => 'btn vtn-default', 'onclick' => 'fastFilterYesterday()']) }}
                        {{ Form::button('7 dias', ['class' => 'btn vtn-default', 'onclick' => 'fastFilterDaysBack(7)']) }}
                        {{ Form::button('30 dias', ['class' => 'btn vtn-default', 'onclick' => 'fastFilterDaysBack(30)']) }}
                    </div>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        
    </div>
</div>
@endsection

