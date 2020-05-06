@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1 class="pull-left">Dashboard</h1>
    <br>
    <div>Atualizado em {{ date('H:i:s') }}</div>
</section>

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    @can('dashboard.table')
    <div class="box box-primary">
        <div class="box-body">
                @include('home.dashboardtable')
        </div>
    </div>
    @endcan
    <div class="text-center">
    
    </div>
</div>

@endsection
