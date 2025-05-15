@if (isset($dataFieldImage))
    <p>{{ $dataFieldImage['title'] }}</p>
    <img style="max-width: 200px;" src="{{ $dataFieldImage['src'] }}" alt="imagen_registro_calificado">
    <p>{{ $dataFieldImage['description'] }}</p>
@else
    <p>No se encontró información de la imagen.</p>
@endif
