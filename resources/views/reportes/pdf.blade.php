<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Cirugías</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub {
            text-align: center;
            margin-bottom: 15px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #777;
            padding: 5px;
            font-size: 9px;
            vertical-align: middle;
        }

        th {
            background: #e9ecef;
            font-weight: bold;
            text-align: center;
        }

        td {
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Reporte de Cirugías</h2>
    <div class="sub">Hospital Belén - Sala de Operaciones</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha Solicitud</th>
                <th>Hora Solicitud</th>
                <th>Fecha Programada</th>
                <th>Hora Programada</th>
                <th>Fecha Inicio</th>
                <th>Hora Inicio</th>
                <th>Fecha Culminación</th>
                <th>Hora Culminación</th>
                <th>Sala</th>
                <th>Paciente</th>
                <th>Operación</th>
                <th>Servicio</th>
                <th>Cirujano</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cirugias as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->tipo_solicitud }}</td>
                <td>{{ $c->estado }}</td>
                <td>{{ $c->para_el_dia }}</td>
                <td>{{ $c->a_horas }}</td>
                <td>{{ $c->fecha_programada }}</td>
                <td>{{ $c->hora_programada }}</td>
                <td>{{ $c->fecha_inicio }}</td>
                <td>{{ $c->hora_inicio }}</td>
                <td>{{ $c->fecha_culminacion }}</td>
                <td>{{ $c->hora_culminacion }}</td>
                <td>{{ $c->sala_operacion }}</td>
                <td>{{ $c->paciente }}</td>
                <td>{{ $c->operacion }}</td>
                <td>{{ $c->servicio }}</td>
                <td>{{ $c->cirujano_principal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>