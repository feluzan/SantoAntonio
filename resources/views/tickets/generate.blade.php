@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gerar Ticket Virtual
        </h1>
    </section>
    <div class="content"> 
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div class="form-group">
                        {!! Form::label('refeicao_nome', 'Refeição:') !!}
                        <p>{{ $refeicao->nome }}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('horario_inicio', 'Início:') !!}
                        <p>{{ $refeicao->inicio }}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('horario_fim', 'Fim:') !!}
                        <p>{{ $refeicao->fim }}</p>
                    </div>
                </div>


                <div class="row">
                    <div class='col-xs-12'>
                    

                    <?php 
                    if($refeicao->habilitada){
                        $now = Date('H:i:s');
                        if($now<$refeicao->fim){
                            if($now>$refeicao->inicio){
                                ?> {!! Form::open(['route' => 'ticket.confirm']) !!}
                                    

                                    {!! Form::hidden('refeicao_id',$refeicao->id) !!}
                                    {!! Form::hidden('valor', $refeicao->valor) !!}
                                    {!! Form::hidden('emissor_id',auth()->user()->id) !!}
                                    
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('username', 'Usuário/Matrícula:') !!}
                                        {!! Form::text('username', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-sm-12">
                                        {!! Form::submit('Gerar Ticket Virtual', ['class' => 'btn btn-success']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                <?php 
                            }else{
                                ?> 
                                    {!! Form::label('not_yet','Com fome? Calma! Está muito cedo para essa refeição.') !!}
                                <?php
                            }
                        }else{
                            ?> 
                                {!! Form::label('too_late','Ops, tarde demais. Essa refeição já passou do horário.') !!}
                            <?php
                        }
                    }else{
                        ?> 
                            {!! Form::label('block','Tem certeza? Essa refeição está bloqueada para novos tickets.') !!}
                        <?php
                    }
                    ?>
                   

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
