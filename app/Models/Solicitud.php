<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicituds';

    protected $fillable = [
        'tipo_solicitud',
        'intervencion',
        'estado',
        'para_el_dia',
        'a_horas',
        'fecha_programada',
        'hora_programada',
        'fecha_inicio',
        'hora_inicio',
        'sala_operacion',
        'servicio',
        'n_historia',
        'id_paciente_sigh',
        'paciente',
        'edad',
        'cama',
        'codigo_diagnostico',
        'diagnostico',
        'operacion',
        'codigo_operacion',
        'hto',
        'hb',
        'gs',
        'rh',
        'cirujano_principal',
        'primer_ayudante',
        'segundo_ayudante',
        'tercer_ayudante',
        'instrumentista',
        'tiempo_operativo_aprox',
        'posicion_paciente',
        'fecha_culminacion',
        'hora_culminacion',
        'observacion_culminacion',
    ];
}
