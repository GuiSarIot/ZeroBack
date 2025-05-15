<table class="tabla">
    <thead>
        @if(isset($dataTable['titulo'][0]) && $dataTable['titulo'][0] != '')
            <tr>
                <th colspan="{{ sizeof($dataTable['body']) + 1 }}" class="titulo">{{$dataTable['titulo'][0]}}</th>
            </tr>
        @endif
    </thead>
    <tbody>
        @if (sizeof($dataTable['body']) == 0)
            <tr>
                <td colspan="{{ sizeof($dataTable['headers']) + 1 }}" style="text-align: center;">Sin Registros</td>
            </tr>
        @else
            @foreach ($dataTable['headers'] as $headerIndex => $header)
                <tr>
                    <th>{{ $header }}</th>
                    @foreach ($dataTable['body'] as $row)
                        @php
                            $valores = json_decode($row['valores']);
                        @endphp
                        <td>{{ $valores[$headerIndex] ?? '' }}</td>
                    @endforeach
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
