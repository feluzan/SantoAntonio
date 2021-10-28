@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/home.js') }}" defer></script>

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')



<div class="content">
    <div class="clearfix"></div>
    @if(Auth::user()->isArchived())
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        Olá, {{ Auth::user()->getName() }}. Atualmente seu usuário está bloqueado no sistema. Se isso for um erro, contacte o setor que gerencia o auxílio estudantil.
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('flash::message')

    @can('dashboard.table')
    @foreach($charts as $key => $chartItems)
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
                <div class="row">
                    
                    
                        <div class="col-xs-12">
                            <h3>{!! $key !!}</h3>
                        </div>
                        <div class="col-xs-4">
                            {!! $chartItems['dayChart']->render() !!}
                        </div>
                        <div class="col-xs-8">
                            {!! $chartItems['weekChart']->render() !!}
                        </div>
                    
                </div>

        </div>
    </div>
    @endforeach
    @endcan
</div>

@endsection
