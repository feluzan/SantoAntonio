@extends('layouts.app')

<?php
    // dd($refeicao, $assistido);
?>

@section('content')
    <section class="content-header">
        <h1>
            Confirmar Informações do Ticket Virtual
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
                        {!! Form::label('nome_assistido', 'Nome do assistido:') !!}
                        <p>{{ $assistido->name }}</p>
                        <img style="max-width: 300px" src="/uploads/avatars/{!! $assistido->getAvatar() !!}" />
                    </div>
                    <div class="form-group">

                        {!! Form::open(['route' => 'tickets.store']) !!}  
                            <!-- Submit Field -->
                            {!! Form::hidden('refeicao_id',$refeicao->id) !!}
                            {!! Form::hidden('valor', $refeicao->valor) !!}
                            {!! Form::hidden('emissor_id',auth()->user()->id) !!}
                            {!! Form::hidden('username',$assistido->username) !!}


                            <div class="form-group col-sm-12">
                                {!! Form::submit('Confirmar Ticket Virtual', ['class' => 'btn btn-success']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
