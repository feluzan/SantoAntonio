@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Refeições</h1>
        <h1 class="pull-right">
           @can('refeicaos.create')
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-left:10px;" href="{{ route('refeicaos.create') }}">Adicionar Refeição</a>
           @endcan
           @can('refeicaos.report')
           <a class="btn bg-navy pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('refeicaos.reportBuild') }}"><i class="far fa-file-pdf"></i></a>
           @endcan
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('refeicaos.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

