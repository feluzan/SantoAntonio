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
                padding-right: 10px;
            }
            
            /* .column1 {
                width: 33%;
                padding-left: 40px;
            }
            
            .column2 {
                width: 13%;
            }
            
            .column3 {
                width: 22%;
            }
            
            .column4 {
                width: 19%;
            }
            
            .column5 {
                width: 13%;
            } */
            
            .table100-head th {
                /* padding-top: 18px; */
                /* padding-bottom: 18px; */
            }
            
            .table100-body td {
                /* padding-top: 16px; */
                /* padding-bottom: 16px; */
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
                                    @php
                                        $contador = 1;
                                    @endphp
                                    @foreach($fields as $field_name => $field_label)
                                        <th class="cell100 column{{ $contador }}">{{ $field_label }}</th>
                                        @php
                                        $contador += 1;
                                        @endphp
                                    @endforeach
                                    @if(isset($acoes) && count($acoes))
                                        <th>Ações</th>
                                    @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach



                                    <!-- ----------------------------------------------------------------------- -->
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @foreach($items as $item)
                                        <tr class="row100 body">
                                            @php
                                                $contador = 1;
                                            @endphp
                                            @foreach($fields as $field_name => $field_label)
                                                <td class="cell100 column{{ $contador }}">{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
                                                @php
                                                $contador += 1;
                                                @endphp
                                            @endforeach
                                            @if(isset($acoes) && count($acoes))
                                                <td>
                                                    @foreach ($acoes as $route => $options)
                                                        <?php
                                                            $params = [];
                                                            foreach($options['params'] as $param) {
                                                                $params[$param] =  $item->{$param};
                                                            }
                                                        ?>
                                                        <a href="{{ route($route, $params) }}">{{ $options['link'] }}</a> <br>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <!-- ------------------------------------------------------------- -->
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </body>
</html>