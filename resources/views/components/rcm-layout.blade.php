<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento Maestro</title>
</head>
<body>
    <style>
        p {
            color: #000;
            text-indent: 40px;
            text-align: justify;
        }

        p.texto_normal{
            text-indent: 0px;
        }

        h2 {
            color: #39A900;
            text-align: center!important;
        }

        h3 {
            color: #000;
            font-weight: bold;
        }

        h4,h5 {
            color: #000;
            font-style: italic;
        }

        .cita{
            max-width: 80%;
            margin: 0 auto;
            font-style: italic;
        }
        p.titulo_imagen,p.titulo_tabla{
            font-style: italic;
            font-size: 10px;
            text-indent: 0;
        }
        .nota_imagen,.nota_tabla{
            font-size: 10px;
            text-indent: 0;
        }
        .negrilla{
            font-weight: bold;
        }
        .cursiva{
            font-style: italic;
        }

        .subrayado{
            text-decoration: underline;
        }

        table{
            min-width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        table th{
            background-color: #433C29;
            border: .5px solid #433C29;
            color: white;
            text-align: center;
        }

        table th.titulo{
            border-bottom: .5px solid #e4e4e4;
            font-size: 10px;
        }
        table tr{
            text-align: justify;
        }
        table tr td{
            border: .5px solid #000;
        }

        ul,ol{
            text-align: justify
        }
        .cont-img{
            text-align: center;
        }
        .cont-portada{
            font-weight: bold;
            padding-left: 60px;
        }
        .cont-portada div{
            font-style: italic;
        }
        .cont-portada p{
            text-align: center;
            text-indent: 0px;
        }
        .cont-equipo-colaborador{
            line-height: 1;
        }
        .cont-equipo-colaborador p{
            line-height: 0.5;
            text-indent: 0px;
        }
        .cont-equipo-colaborador div{
            margin: 0;
        }
        .cont-equipo-colaborador .cont-equipo h4{
            margin-top: 50px;
            font-style: normal;
        }
        .cont-equipo-colaborador .cont-equipo .txt-equipo{
            margin: 0;
        }
        .cont-equipo-colaborador .cont-equipo .txt-equipo p{
            line-height: 0.5;
        }
        .cont-como-documenta h2{
            color: #000000;
            text-align: left!important;
        }
    </style>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
