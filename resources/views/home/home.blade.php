@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/home.js') }}" defer></script>

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')

<section class="content-header">
    <h1 class="pull-left">Dashboard</h1>
    <br>
</section>

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    @can('dashboard.table')
    
    @endcan
    <br>

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
