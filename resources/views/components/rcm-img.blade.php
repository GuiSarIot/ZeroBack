@props(['nombreCarpeta','img','width','height'])
<div class="cont-img">
    <img src="{{ public_path('registro_calificado_maestro/images/'.$nombreCarpeta.'/'.$img) }}" width="{{ isset($width) ? (($width * 96) / 2.54).'px' : '100%' }}" height="{{ isset($height) ? (($height * 96) / 2.54).'px' : '100%' }}" alt="{{'img_'.$img}}" class="align-center">
</div>
