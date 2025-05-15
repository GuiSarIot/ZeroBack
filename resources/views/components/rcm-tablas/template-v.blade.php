<table class="tabla">
    <thead>
        @if(isset($dataTable['titulo'][0]) && $dataTable['titulo'][0] != '')
            <tr>
                <th colspan="{{ sizeof($dataTable['headers']) }}" class="titulo">{{$dataTable['titulo'][0]}}</th>
            </tr>
        @endif
        <tr>
            @foreach ($dataTable['headers'] as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @if (sizeof($dataTable['body']) == 0)
            <tr>
                <td colspan="{{ sizeof($dataTable['headers']) }}" style="text-align: center;">Sin Registros</td>
            </tr>

        @else
            @foreach ($dataTable['body'] as $row)
                @php
                    $row = json_decode($row['valores']);
                    $diff = sizeof($dataTable['headers']) - sizeof($row);
                @endphp
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                    @if ($diff > 0)
                        @for ($i = 0; $i < $diff; $i++)
                            <td></td>
                        @endfor
                    @endif
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
