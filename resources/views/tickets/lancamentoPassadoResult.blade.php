@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Gerar Tickets Virtuais de Dias Anteriores - Resultado</h1>
        <!-- <h1 class="pull-right">
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>


        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        {{ "Data a ser lançada no ticket: "}}
                        {!! $date !!}
                    </div>

                    <div class="col-xs-12">
                        {{ "Refeição: "}}
                        {!! $refeicao->nome !!}
                    </div>

                    <div class="col-xs-12">

                        <div class="table-responsive">
                            <table class="table" id="tickets-table">
                                <thead>
                                    <tr>
                                        
                                        <th>Status</th>
                                        <th>Infomação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($log as $logRow)
                                    <tr>
                                        @if($logRow[0])
                                            <td>
                                                <span class="badge bg-success">SUCESSO</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge" style="background-color:red;">ERRO</span>
                                            </td>
                                        @endif
                                        <td>
                                            {!! $logRow[1] !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                   

                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

