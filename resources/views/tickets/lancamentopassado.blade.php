@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Gerar Tickets Virtuais de Dias Anteriores</h1>
        <!-- <h1 class="pull-right">
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fas fa-exclamation-triangle"></i> MUITO CUIDADO</h4>
                            Essa tela permite lançar tickets de dias anteriores, quando o sistema ficou indisponível (por exemplo em queda de energia).
                            <br>
                            As ações executadas aqui não podem ser desfeitas.
                        </div>
                    </div>

                    <div class="col-xs-12">
                        {!! Form::open(['route' => 'tickets.pastStore', 'id' => 'lancamento-passado']) !!}

                        {!! Form::label('dateLabel', 'Data passada:') !!}
                        {{ Form::date('dateInput', $date,['id'=>'dateInput']  ) }}

                        <br>

                        <?php
                            // $refeicoes = Refeicoes::all()->where('habilitada','=',)->pluck('title', 'id');
                        ?>

                        {!! Form::label('refeicaoLabel','Seleciona a Refeição:')!!}
                        {!! Form::select('refeicao_id', $refeicaoOptions, null, []) !!}

                        <br>

                        {!! Form::label('listaMatriculasLabel','Lista de matrículas:')!!}
                        <div>Uma matrícula por linha (utilize ENTER)</div>
                        {!! Form::textarea('listaMatriculas',$listaMatriculas ?? '',['rows' => 10, 'cols' => 30]) !!}
                        <br>
                        {!! Form::button('Emitir tickets do passado', ['type' => 'submit', 'class' => 'btn btn-warning',  'title' => 'Emitir tickets do passado']) !!}
                        {!! Form::close() !!}
                    </div>
                   

                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

