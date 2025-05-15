<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>@if (isset($dataTable) && sizeof($dataTable) > 0)
    @php
        $template = 'components.rcm-tablas.template-';
        $template = $dataTable['orientacion'] == 'vertical' ? $template.'v' : $template.'h';
    @endphp
    <style>
        .tabla{
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .tabla th{
            background-color: #433C29;
            border: .5px solid #433C29;
            color: white;
            text-align: center;
        }
        .tabla th.titulo{
            border-bottom: .5px solid #e4e4e4;
            font-size: 10px;
        }
        .tabla tr{
            text-align: justify;
            /* border-bottom: .5px solid #000; */
        }
        .tabla tr td{
            border: .5px solid #000;
        }
    </style>
    {{-- <div style="margin: 10px 0"> --}}
        @include($template,[$dataTable])
    {{-- </div> --}}
@else
    <p>No se encontraron registros relacionados a esta tabla</p>
@endif
