@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gerar Ticket Virtual
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class='col-xs-12'>

                    <?php 
                    if($refeicao->habilitada){
                        $now = Date('H:i:s');
                        if($now<$refeicao->fim){
                            if($now>$refeicao->inicio){
                                ?> {!! Form::open(['route' => 'tickets.store']) !!}

                                    @include('tickets.fields')

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
