@inject('helper', 'App\Services\ViewsHelperService')

<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="{{ asset('css/reportPDF.css') }} " media="all" type="text/css"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body{
                max-width: 297mm;
                margin: 1cm 1cm 1cm 1cm;
                padding: 0px;
            }

            body>div{
                max-width:267mm;
            }
            /* ------------------------------------ */
            h1,h2,h3,h4,h5,h6 {margin: 0px;}
            
            p {margin: 0px;}
            
            ul, li {
                margin: 0px;
                list-style-type: none;
            }
            
            
            /* ------------------------------------ */
            input {
                display: block;
                outline: none;
                border: none !important;
            }
            
            textarea {
                display: block;
                outline: none;
            }
            
            textarea:focus, input:focus {
                border-color: transparent !important;
            }
            
            /*//////////////////////////////////////////////////////////////////
            [ Table ]*/
            
           
            .container-table100 {
                width: 100%;
                /* min-height: 100vh; */
                /* background: #fff; */
            
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                /* padding: 33px 30px; */
            }
            
            .wrap-table100 {
                width: 100%;
            }
            
            /*//////////////////////////////////////////////////////////////////
            [ Table ]*/
            .table100 {
                background-color: #fff;
            }
            
            table {
                width: 100%;
            }
            
            th, td {
                font-weight: unset;
                padding-right: 1px;
            }
            
            /*==================================================================
            [ Fix header ]*/
            .table100 {
                position: relative;
                padding-top: 1cm;
                max-width: 260mm;
            }
            
            .table100-head {
                position: absolute;
                width: 100%;
                top: 0;
                left: 0;
            }
            
            .table100-body {
                /* max-height: 585px; */
                overflow: auto;
            }
            
            
            /*==================================================================
            [ Ver1 ]*/
            
            .table100.ver1 th {
                font-size: 18px;
                color: #000;
                line-height: 1.4;
            
                background-color: #6c7ae0;
            }
            
            .table100.ver1 td {
                font-size: 15px;
                color: #808080;
                line-height: 1.4;
            }
            
            .table100.ver1 .table100-body tr:nth-child(even) {
                background-color: #f8f6ff;
            }
            
            /*---------------------------------------------*/
            
            .table100.ver1 {
                border-radius: 10px;
                /* overflow: hidden; */
                /* box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15); */
                /* -moz-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15); */
                /* -webkit-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15); */
                /* -o-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15); */
                /* -ms-box-shadow: 0 0px 40px 0px rgba(0, 0, 0, 0.15); */
            }
            
            .table100.ver1 .ps__rail-y {
                right: 5px;
            }
            
            .table100.ver1 .ps__rail-y::before {
                background-color: #ebebeb;
            }
            
            .table100.ver1 .ps__rail-y .ps__thumb-y::before {
                background-color: #cccccc;
            }

            tr.soma-geral{
                font-weight: bold;
            }

            .table100.ver1 tr.soma-geral td{
                color: #000;
                background-color: #6c7ae0;
            }

            @media print {
                body {
                    margin: 0;
                    box-shadow: 0;
                }
            }
            #report-header,
            #report-footer {
                position: fixed;
                left: 1cm;
                right: 1cm;
                color: #aaa;
                font-size: 0.9em;
                text-align: center;
            }
            #report-header{
                top: 0;
                border-bottom: 0.1pt solid #aaa;
                margin-bottom: 5px;
            }
            #report-footer {
                bottom: 0;
                border-top: 0.1pt solid #aaa;
                /* margin-top: 5px; */
            }
            .page-number:before {
                content: "Página " counter(page);
            }
            .report-title{
                margin: 5px;
            }
  
        </style>
    </head>
    <body>

        <div id="report-header">
            <div>INSTITUTO FEDERAL DO ESPÍRITO SANTO - CAMPUS MONTANHA</div>
            <div class="report-title">{{ $metaData['title'] }}</div>
            <div class="report-title">{{ $metaData['filter'] }}</div>

        </div>
        <div id="report-footer">
            Santo Antônio - Sistema de gestão de auxílio refeição. Documento gerado automaticamente. <span style="float:right" class="page-number"></span>
        </div>

        <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100 ver1">
                        <div class="table100-body js-pscroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }} width:20%;" rowspan="2">
                                            <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                    Nome
                                                </span>
                                            </div>
                                        </th>
                                        @foreach($refeicoes as $refeicao)
                                            <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }}" class="cell100" colspan="2">
                                                <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                    <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                        {{ $refeicao }}
                                                    </span>
                                                </div>
                                            </th>
                                        @endforeach
                                        <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }}" class="cell100" colspan="2">
                                            <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                    TOTAL
                                                </span>
                                            </div>
                                        </th>


                                    </tr>
                                    <tr>
                                        @foreach($refeicoes as $refeicao)
                                            <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }};width:{{ $columnsWidth['qtd'] }}" class="cell100">
                                                <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                    <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                        Qtd
                                                    </span>
                                                </div>
                                            </th>
                                            <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }};width:{{ $columnsWidth['valor'] }}" class="cell100">
                                                <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                    <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                        R$
                                                    </span>
                                                </div>
                                            </th>
                                        @endforeach

                                        <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }};width:{{ $columnsWidth['qtd'] }}" class="cell100">
                                            <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                    Qtd
                                                </span>
                                            </div>
                                        </th>
                                        <th style="{{ isset($extraStyle['th']) ? $extraStyle['th'] : '' }};width:{{ $columnsWidth['valor'] }}" class="cell100">
                                            <div style="{{ isset($extraStyle['th div']) ? $extraStyle['th div'] : '' }}">
                                                <span style="{{ isset($extraStyle['th span']) ? $extraStyle['th span'] : '' }}">
                                                    R$
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($reportData as $nome => $consumo)
                                        <tr class="row100 body {{ isset($item->rowExtraClass) ? $item->rowExtraClass : '' }}">
                                            <td>{!! $nome !!}</td>
                                            @foreach($refeicoes as $refeicao)
                                                @if(array_key_exists($refeicao,$consumo))
                                                <td style="text-align:center;">{!! $consumo[$refeicao]["quantidade"] !!}</td>
                                                <td style="text-align:center;">{!! $helper->formatCurrencyValue($consumo[$refeicao]["valorTotal"]) !!}</td>
                                                @else
                                                <td style="text-align:center;">0</td>
                                                <td style="text-align:center;">{!! $helper->formatCurrencyValue(0) !!}</td>
                                                @endif
                                                
                                            @endforeach
                                            <td style="text-align:center;">{!! $consumo["total"]["quantidade"] !!}</td>
                                            <td style="text-align:center;">{!! $helper->formatCurrencyValue($consumo["total"]["valorTotal"]) !!}</td>
                                        </tr>
                                    @endforeach

                                    <tr style="background-color:rgba(0,0,0,0)!important"><td><br></td></tr>

                                    <tr style="font-weight:bold;margin-top:10px;background-color:#CCCCCC;color:#000000!important;">
                                        <td style="color:#000000;">TOTAL</td>
                                        @foreach($refeicoes as $refeicao)
                                            <td style="text-align:center;">{!! $totais[$refeicao]["quantidade"] !!}</td>
                                            <td style="text-align:center;">{!! $helper->formatCurrencyValue($totais[$refeicao]["valorTotal"]) !!}</td>
                                        @endforeach
                                        <td style="color:#000000;text-align:center;">{!! $totais['total']["quantidade"] !!}</td>
                                        <td style="color:#000000;text-align:center;">{!! $helper->formatCurrencyValue($totais['total']["valorTotal"]) !!}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </body>
</html>