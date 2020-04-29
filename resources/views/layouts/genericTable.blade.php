@inject('helper', 'App\Services\ViewsHelperService')

<div class="table-responsive">
    <table class="table" id="user-table">
        <thead>
            <tr>
                @foreach($fields as $field_name => $field_label)
                    <th>{{ $field_label }}</th>
                @endforeach
                @if(isset($acoes) && count($acoes))
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    @foreach($fields as $field_name => $field_label)
                        <td>{!! $helper->get_dot_notation($item, $field_name)  !!}</td>
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
        </tbody>
    </table>
</div>
