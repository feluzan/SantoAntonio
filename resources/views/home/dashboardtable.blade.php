@inject('helper', 'App\Services\ViewsHelperService')

<div class="table-responsive">
    <table class="table" id="refeicaos-table">
        <thead>
            <tr>
                <th>Refeição</th>
                <th>auxilos utilizados hoje</th>
                <th>total de auxilios</th>
                <th>valor utilizado</th>
            </tr>
        </thead>
        <tbody>

        @foreach($data as $key => $items)
            <tr>
                <td> {{ $key }} </td>
                <td> {{ count($items[0]) }} ({{ $helper->formatPorcentagem(count($items[0])/count($items[1])) }})</td>
                <td> {{ count($items[1]) }} </td>
                <td> {{ $helper->formatCurrencyValue(array_reduce($items[0]->toArray(), function($carry, $item)
                        {
                            return $carry + $item['valor'];
                        })) }} </td>

                        
            </tr>
                
        @endforeach
        </tbody>
    </table>
</div>
