@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @yield('table_title')
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover datatables">
                            @yield('table_content')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop