<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $query = Solicitud::query();

        if ($request->filled('fecha_inicio')) {
            $query->where(function ($q) use ($request) {
                $q->whereDate('para_el_dia', '>=', $request->fecha_inicio)
                    ->orWhereDate('fecha_programada', '>=', $request->fecha_inicio);
            });
        }

        if ($request->filled('fecha_fin')) {
            $query->where(function ($q) use ($request) {
                $q->whereDate('para_el_dia', '<=', $request->fecha_fin)
                    ->orWhereDate('fecha_programada', '<=', $request->fecha_fin);
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_solicitud')) {
            $query->where('tipo_solicitud', $request->tipo_solicitud);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('paciente', 'like', "%{$buscar}%")
                    ->orWhere('cirujano_principal', 'like', "%{$buscar}%")
                    ->orWhere('servicio', 'like', "%{$buscar}%")
                    ->orWhere('operacion', 'like', "%{$buscar}%")
                    ->orWhere('n_historia', 'like', "%{$buscar}%");
            });
        }

        $solicitudes = $query
            ->orderByDesc('id')
            ->paginate(10)
            ->appends($request->query());

        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
        $mensajes = [
            'tipo_solicitud.required' => 'Debe seleccionar el tipo de solicitud.',
            'tipo_solicitud.in' => 'El tipo de solicitud no es válido.',
            'intervencion.in' => 'La intervención debe ser 1ra, 2da o 3ra.',
            'para_el_dia.required' => 'Debe ingresar la fecha para la cirugía.',
            'para_el_dia.date' => 'La fecha para la cirugía no tiene un formato válido.',
            'a_horas.required' => 'Debe ingresar la hora solicitada.',
            'servicio.required' => 'Debe ingresar el servicio.',
            'n_historia.required' => 'Debe ingresar el número de historia clínica.',
            'paciente.required' => 'Debe ingresar o buscar el paciente.',
            'edad.required' => 'Debe ingresar la edad del paciente.',
            'edad.integer' => 'La edad debe ser un número entero.',
            'codigo_diagnostico.required' => 'Debe ingresar el código de diagnóstico CIE10.',
            'diagnostico.required' => 'Debe ingresar el diagnóstico.',
            'codigo_operacion.required' => 'Debe ingresar el código de operación CPT.',
            'operacion.required' => 'Debe ingresar la operación.',
            'cirujano_principal.required' => 'Debe ingresar el cirujano principal.',
            'tiempo_operativo_aprox.required' => 'Debe ingresar el tiempo operativo aproximado.',
            'posicion_paciente.required' => 'Debe ingresar la posición del paciente.',
        ];

        $data = $request->validate([
            'tipo_solicitud' => ['required', 'in:PROGRAMADA,EMERGENCIA'],
            'intervencion' => ['nullable', 'in:1ra,2da,3ra'],

            'para_el_dia' => ['required', 'date'],
            'a_horas' => ['required'],

            'fecha_programada' => ['nullable', 'date'],
            'hora_programada' => ['nullable'],
            'sala_operacion' => ['nullable', 'string', 'max:50'],

            'servicio' => ['required', 'string', 'max:255'],
            'n_historia' => ['required', 'string', 'max:50'],
            'id_paciente_sigh' => ['nullable', 'integer'],
            'paciente' => ['required', 'string', 'max:255'],
            'edad' => ['required', 'integer'],
            'cama' => ['nullable', 'string', 'max:50'],

            'codigo_diagnostico' => ['required', 'string', 'max:20'],
            'diagnostico' => ['required', 'string'],
            'operacion' => ['required', 'string'],
            'codigo_operacion' => ['required', 'string', 'max:100'],

            'hto' => ['nullable'],
            'hb' => ['nullable'],
            'gs' => ['nullable', 'string', 'max:5'],
            'rh' => ['nullable', 'string', 'max:5'],

            'cirujano_principal' => ['required', 'string', 'max:255'],
            'primer_ayudante' => ['nullable', 'string', 'max:255'],
            'segundo_ayudante' => ['nullable', 'string', 'max:255'],
            'tercer_ayudante' => ['nullable', 'string', 'max:255'],
            'instrumentista' => ['nullable', 'string', 'max:255'],

            'tiempo_operativo_aprox' => ['required', 'string', 'max:100'],
            'posicion_paciente' => ['required', 'string', 'max:100'],
        ], $mensajes);

        $data['estado'] = 'S';
        $data['fecha_programada'] = null;
        $data['hora_programada'] = null;
        $data['sala_operacion'] = null;

        $conflicto = $this->validarConflictoPersonal($data);

        if ($conflicto) {
            return back()
                ->withErrors(['personal_conflicto' => $conflicto])
                ->withInput();
        }

        Solicitud::create($data);

        return redirect()
            ->route('solicitudes.index')
            ->with('ok', 'Solicitud creada correctamente.');
    }

    private function validarConflictoPersonal(array $data, $idExcluir = null)
    {
        $fecha = $data['para_el_dia'] ?? null;
        $hora  = $data['a_horas'] ?? null;

        if (!$fecha || !$hora) {
            return null;
        }

        $personalIngresado = [
            'Cirujano Principal' => trim($data['cirujano_principal'] ?? ''),
            '1er Ayudante'       => trim($data['primer_ayudante'] ?? ''),
            '2do Ayudante'       => trim($data['segundo_ayudante'] ?? ''),
            '3er Ayudante'       => trim($data['tercer_ayudante'] ?? ''),
            'Instrumentista'     => trim($data['instrumentista'] ?? ''),
        ];

        $personalIngresado = array_filter($personalIngresado, fn($v) => $v !== '');

        if (empty($personalIngresado)) {
            return null;
        }

        $query = Solicitud::where('para_el_dia', $fecha)
            ->where('a_horas', $hora);

        if ($idExcluir) {
            $query->where('id', '!=', $idExcluir);
        }

        $solicitudes = $query->get();

        foreach ($solicitudes as $solicitud) {
            $personalExistente = [
                'Cirujano Principal' => trim($solicitud->cirujano_principal ?? ''),
                '1er Ayudante'       => trim($solicitud->primer_ayudante ?? ''),
                '2do Ayudante'       => trim($solicitud->segundo_ayudante ?? ''),
                '3er Ayudante'       => trim($solicitud->tercer_ayudante ?? ''),
                'Instrumentista'     => trim($solicitud->instrumentista ?? ''),
            ];

            foreach ($personalIngresado as $rolNuevo => $nombreNuevo) {
                foreach ($personalExistente as $rolExistente => $nombreExistente) {
                    if (
                        $nombreExistente !== '' &&
                        mb_strtoupper($nombreNuevo) === mb_strtoupper($nombreExistente)
                    ) {
                        return "El profesional '{$nombreNuevo}' ya está asignado en otra operación el {$fecha} a las {$hora} como {$rolExistente}.";
                    }
                }
            }
        }

        return null;
    }

    private function validarConflictoProgramacion(array $data, $idExcluir = null)
    {
        $fecha = $data['fecha_programada'] ?? null;
        $hora = $data['hora_programada'] ?? null;
        $sala = trim($data['sala_operacion'] ?? '');
        $medico = trim($data['cirujano_principal'] ?? '');

        if (!$fecha || !$hora || !$sala) {
            return null;
        }

        $salaOcupada = Solicitud::whereDate('fecha_programada', $fecha)
            ->where('hora_programada', $hora)
            ->where('sala_operacion', $sala)
            ->whereIn('estado', ['P', 'E'])
            ->when($idExcluir, fn($q) => $q->where('id', '!=', $idExcluir))
            ->first();

        if ($salaOcupada) {
            return "No se puede programar. La {$sala} ya está asignada el {$fecha} a las {$hora} para otra cirugía.";
        }

        if ($medico !== '') {
            $medicoProgramado = Solicitud::whereDate('fecha_programada', $fecha)
                ->where('hora_programada', $hora)
                ->whereIn('estado', ['P', 'E'])
                ->whereNotNull('cirujano_principal')
                ->when($idExcluir, fn($q) => $q->where('id', '!=', $idExcluir))
                ->whereRaw('UPPER(TRIM(cirujano_principal)) = ?', [mb_strtoupper($medico)])
                ->first();

            if ($medicoProgramado) {
                return "No se puede programar. El médico {$medico} ya está asignado el {$fecha} a las {$hora} en " .
                    ($medicoProgramado->sala_operacion ?? 'otra sala') . ".";
            }

            $medicoEnCurso = Solicitud::where('estado', 'E')
                ->whereNotNull('cirujano_principal')
                ->when($idExcluir, fn($q) => $q->where('id', '!=', $idExcluir))
                ->whereRaw('UPPER(TRIM(cirujano_principal)) = ?', [mb_strtoupper($medico)])
                ->first();

            if ($medicoEnCurso) {
                return "No se puede programar. El médico {$medico} actualmente está operando en " .
                    ($medicoEnCurso->sala_operacion ?? 'otra sala') . ".";
            }
        }

        return null;
    }

    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        return view('solicitudes.show', compact('solicitud'));
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitudes.edit', compact('solicitud'));
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $data = $request->validate([
            'tipo_solicitud' => ['required', 'in:PROGRAMADA,EMERGENCIA'],
            'intervencion' => ['nullable', 'in:1ra,2da,3ra'],
            'para_el_dia' => ['nullable', 'date'],
            'a_horas' => ['nullable'],
            'fecha_programada' => ['nullable', 'date'],
            'hora_programada' => ['nullable'],
            'sala_operacion' => ['nullable', 'string', 'max:50'],
            'servicio' => ['nullable', 'string', 'max:255'],
            'n_historia' => ['nullable', 'string', 'max:50'],
            'id_paciente_sigh' => ['nullable', 'integer'],
            'paciente' => ['nullable', 'string', 'max:255'],
            'edad' => ['nullable', 'integer'],
            'cama' => ['nullable', 'string', 'max:50'],
            'codigo_diagnostico' => ['nullable', 'string', 'max:20'],
            'diagnostico' => ['nullable', 'string'],
            'operacion' => ['nullable', 'string'],
            'codigo_operacion' => ['nullable', 'string', 'max:100'],
            'hto' => ['nullable'],
            'hb' => ['nullable'],
            'gs' => ['nullable', 'string', 'max:5'],
            'rh' => ['nullable', 'string', 'max:5'],
            'cirujano_principal' => ['nullable', 'string', 'max:255'],
            'primer_ayudante' => ['nullable', 'string', 'max:255'],
            'segundo_ayudante' => ['nullable', 'string', 'max:255'],
            'tercer_ayudante' => ['nullable', 'string', 'max:255'],
            'instrumentista' => ['nullable', 'string', 'max:255'],
            'tiempo_operativo_aprox' => ['nullable', 'string', 'max:100'],
            'posicion_paciente' => ['nullable', 'string', 'max:100'],
        ]);

        $conflicto = $this->validarConflictoPersonal($data, $solicitud->id);

        if ($conflicto) {
            return back()
                ->withErrors(['personal_conflicto' => $conflicto])
                ->withInput();
        }

        if (
            $request->filled('fecha_programada') &&
            $request->filled('hora_programada') &&
            $request->filled('sala_operacion')
        ) {
            $conflictoProgramacion = $this->validarConflictoProgramacion($data, $solicitud->id);

            if ($conflictoProgramacion) {
                return back()
                    ->withErrors(['programacion_conflicto' => $conflictoProgramacion])
                    ->withInput();
            }

            $data['estado'] = 'P';
        }

        $solicitud->update($data);

        return redirect()->route('solicitudes.index')
            ->with('ok', 'Solicitud actualizada.');
    }

    public function culminar($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        return view('solicitudes.culminar', compact('solicitud'));
    }

    public function guardarCulminacion(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $data = $request->validate([
            'fecha_culminacion' => ['required', 'date'],
            'hora_culminacion' => ['required'],
            'observacion_culminacion' => ['nullable', 'string'],
        ]);

        $data['estado'] = 'C';

        $solicitud->update($data);

        return redirect()
            ->route('solicitudes.index')
            ->with('ok', 'Operación culminada correctamente.');
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $solicitud->delete();

        return redirect()->route('solicitudes.index')
            ->with('ok', 'Solicitud eliminada correctamente.');
    }
}
