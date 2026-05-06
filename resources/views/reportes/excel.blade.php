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