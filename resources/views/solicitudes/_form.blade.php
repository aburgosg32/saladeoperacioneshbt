@php
$s = $solicitud ?? null;
$esEdicion = isset($solicitud);
@endphp

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<style>
    :root {
        --bg0: #061218;
        --bg1: #0a1d28;
        --panel: rgba(12, 40, 56, .62);
        --panel2: rgba(12, 40, 56, .35);
        --line: rgba(255, 255, 255, .12);
        --text: #eaf3f8;
        --muted: rgba(234, 243, 248, .72);
        --primary: #2bd4c5;
        --primary2: #1bb3f2;
        --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        --radius: 18px;
    }

    .or-page {
        min-height: calc(100vh - 80px);
        padding: 22px 0 34px;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        color: var(--text);
    }

    .or-container {
        width: min(1100px, 92vw);
        margin: 0 auto;
    }

    .or-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .or-title {
        margin: 0;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -.2px;
    }

    .or-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 12.5px;
        line-height: 1.6;
    }

    .or-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .or-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 800;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
        white-space: nowrap;
    }

    .or-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
    }

    .or-btn-primary {
        border-color: rgba(43, 212, 197, .60);
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
    }

    .or-btn-primary:hover {
        border-color: rgba(43, 212, 197, .90);
    }

    .or-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27, 179, 242, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .or-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .or-panel-head .label {
        font-weight: 900;
        font-size: 13px;
        letter-spacing: .2px;
    }

    .or-count {
        color: var(--muted);
        font-size: 12px;
        border: 1px solid var(--line);
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(12, 40, 56, .30);
    }

    .or-panel-body {
        padding: 16px;
    }

    .paper {
        border: 1px solid rgba(255, 255, 255, .10);
        border-radius: 18px;
        background: rgba(6, 18, 24, .25);
        overflow: hidden;
    }

    .paper-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        padding: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, .10);
        background: rgba(12, 40, 56, .25);
        flex-wrap: wrap;
    }

    .paper-title {
        margin: 0;
        font-size: 14px;
        font-weight: 900;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .paper-meta {
        margin: 6px 0 0;
        font-size: 12px;
        color: var(--muted);
        line-height: 1.5;
    }

    .paper-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 12px;
        padding: 16px;
    }

    .field {
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(12, 40, 56, .22);
        border-radius: 16px;
        padding: 10px 10px 12px;
    }

    .field label {
        display: block;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: rgba(234, 243, 248, .80);
        margin-bottom: 6px;
    }

    .input,
    .select,
    .textarea {
        width: 100%;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(6, 18, 24, .35);
        color: var(--text);
        padding: 10px 10px;
        outline: none;
        font-size: 13px;
        transition: border-color .15s ease, background .15s ease;
    }

    .textarea {
        resize: vertical;
        min-height: 74px;
    }

    .input:focus,
    .select:focus,
    .textarea:focus {
        border-color: rgba(43, 212, 197, .75);
        background: rgba(6, 18, 24, .55);
    }

    .input.is-invalid,
    .select.is-invalid,
    .textarea.is-invalid {
        border-color: rgba(255, 107, 107, .85) !important;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, .12);
    }

    .field-error {
        margin-top: 6px;
        font-size: 12px;
        font-weight: 800;
        color: rgba(255, 107, 107, .95);
        line-height: 1.4;
    }

    .help {
        margin-top: 6px;
        font-size: 12px;
        color: var(--muted);
    }

    .help.ok {
        color: rgba(43, 212, 197, .95);
    }

    .help.err {
        color: rgba(255, 107, 107, .95);
    }

    .c12 {
        grid-column: span 12;
    }

    .c8 {
        grid-column: span 8;
    }

    .c6 {
        grid-column: span 6;
    }

    .c4 {
        grid-column: span 4;
    }

    .c3 {
        grid-column: span 3;
    }

    .c2 {
        grid-column: span 2;
    }

    @media (max-width: 980px) {

        .c8,
        .c6,
        .c4,
        .c3,
        .c2 {
            grid-column: span 12;
        }

        .paper-head {
            align-items: flex-start;
        }
    }

    .divider {
        grid-column: span 12;
        height: 1px;
        background: rgba(255, 255, 255, .10);
        margin: 4px 0;
    }

    .server-error {
        border: 1px solid rgba(255, 107, 107, .35);
        background: rgba(255, 107, 107, .08);
        color: rgba(234, 243, 248, .92);
        padding: 12px 14px;
        border-radius: 16px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .server-error-title {
        font-size: 14px;
        font-weight: 900;
        margin-bottom: 8px;
        color: #ff9a9a;
    }

    .server-error ul {
        margin: 0;
        padding-left: 18px;
        line-height: 1.7;
    }

    #paciente {
        font-weight: 600;
        letter-spacing: .2px;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--bootstrap-5 .select2-selection {
        min-height: 44px !important;
        border-radius: 14px !important;
        border: 1px solid rgba(255, 255, 255, .10) !important;
        background: rgba(6, 18, 24, .35) !important;
        color: #eaf3f8 !important;
        padding: 6px 10px !important;
        box-shadow: none !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single {
        display: flex !important;
        align-items: center !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        color: #eaf3f8 !important;
        padding-left: 0 !important;
        padding-right: 22px !important;
        line-height: 1.4 !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
        color: rgba(234, 243, 248, .55) !important;
    }

    .select2-container--bootstrap-5 .select2-selection__arrow {
        height: 100% !important;
    }

    .select2-container--bootstrap-5 .select2-dropdown {
        background: #0a1d28 !important;
        border: 1px solid rgba(255, 255, 255, .12) !important;
        border-radius: 12px !important;
        overflow: hidden !important;
    }

    .select2-container--bootstrap-5 .select2-search {
        padding: 8px !important;
        background: #0a1d28 !important;
    }

    .select2-container--bootstrap-5 .select2-search__field {
        width: 100% !important;
        background: rgba(6, 18, 24, .55) !important;
        color: #eaf3f8 !important;
        border: 1px solid rgba(255, 255, 255, .10) !important;
        border-radius: 10px !important;
        padding: 8px 10px !important;
        outline: none !important;
    }

    .select2-container--bootstrap-5 .select2-results__options {
        background: #0a1d28 !important;
    }

    .select2-container--bootstrap-5 .select2-results__option {
        color: #eaf3f8 !important;
        padding: 10px 12px !important;
        font-size: 13px !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted {
        background: rgba(27, 179, 242, .25) !important;
        color: #fff !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--selected {
        background: rgba(43, 212, 197, .18) !important;
        color: #fff !important;
    }

    .programacion-box {
        grid-column: span 12;
        border: 1px solid rgba(27, 179, 242, .28);
        background: rgba(27, 179, 242, .08);
        border-radius: 18px;
        padding: 14px;
    }

    .programacion-title {
        margin: 0 0 10px;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: #7fd8ff;
    }

    .programacion-sub {
        margin: 0 0 12px;
        font-size: 12px;
        color: rgba(234, 243, 248, .70);
        line-height: 1.5;
    }

    .programacion-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 12px;
    }

    @media (max-width: 980px) {
        .programacion-grid .c4 {
            grid-column: span 12;
        }
    }
</style>

@if ($errors->any())
<div class="server-error">
    <div class="server-error-title">
        Se encontraron {{ $errors->count() }} error(es) en el formulario:
    </div>

    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@error('personal_conflicto')
<div class="server-error">
    {{ $message }}
</div>
@enderror

<div class="paper">
    <div class="paper-head">
        <div>
            <h2 class="paper-title">Solicitud de Sala de Operaciones</h2>
            <div class="paper-meta">
                Departamento de Anestesiología, Gastroterapia y Centro Quirúrgico<br>
                Hospital Belén de Trujillo
            </div>
        </div>

        <div class="field" style="min-width: 320px;">
            <label>Tipo / Intervención</label>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div>
                    <select class="select @error('tipo_solicitud') is-invalid @enderror" name="tipo_solicitud">
                        <option value="PROGRAMADA" {{ old('tipo_solicitud', $s->tipo_solicitud ?? 'PROGRAMADA') == 'PROGRAMADA' ? 'selected' : '' }}>Programada</option>
                        <option value="EMERGENCIA" {{ old('tipo_solicitud', $s->tipo_solicitud ?? '') == 'EMERGENCIA' ? 'selected' : '' }}>Emergencia</option>
                    </select>

                    @error('tipo_solicitud')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <select class="select @error('intervencion') is-invalid @enderror" name="intervencion">
                        <option value="">Intervención</option>
                        @foreach(['1ra','2da','3ra'] as $it)
                        <option value="{{ $it }}" {{ old('intervencion', $s->intervencion ?? '') == $it ? 'selected' : '' }}>{{ $it }}</option>
                        @endforeach
                    </select>

                    @error('intervencion')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="paper-grid">
        <div class="field c3">
            <label>Para el día</label>
            <input class="input @error('para_el_dia') is-invalid @enderror" type="date" name="para_el_dia" value="{{ old('para_el_dia', $s->para_el_dia ?? '') }}">
            @error('para_el_dia')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c3">
            <label>A horas</label>
            <input class="input @error('a_horas') is-invalid @enderror" type="time" name="a_horas" value="{{ old('a_horas', $s->a_horas ?? '') }}">
            @error('a_horas')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c4">
            <label>Servicio de</label>
            <input class="input @error('servicio') is-invalid @enderror" name="servicio" value="{{ old('servicio', $s->servicio ?? '') }}" placeholder="Ej: Cirugía General">
            @error('servicio')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c2">
            <label>Cama N°</label>
            <input class="input @error('cama') is-invalid @enderror" name="cama" value="{{ old('cama', $s->cama ?? '') }}">
            @error('cama')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="divider"></div>

        <div class="field c2">
            <label>N° Historia Clínica</label>
            <input id="n_historia" class="input @error('n_historia') is-invalid @enderror" name="n_historia" value="{{ old('n_historia', $s->n_historia ?? '') }}" autocomplete="off" inputmode="numeric" pattern="[0-9]*" placeholder="Ingrese HC">
            <input id="id_paciente_sigh" type="hidden" name="id_paciente_sigh" value="{{ old('id_paciente_sigh', $s->id_paciente_sigh ?? '') }}">
            <div id="hc_msg" class="help"></div>
            @error('n_historia')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c8">
            <label>Paciente</label>
            <input id="paciente" class="input @error('paciente') is-invalid @enderror" name="paciente" value="{{ old('paciente', $s->paciente ?? '') }}" readonly>
            @error('paciente')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c2">
            <label>Edad</label>
            <input id="edad" class="input @error('edad') is-invalid @enderror" name="edad" value="{{ old('edad', $s->edad ?? '') }}" readonly>
            @error('edad')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="divider"></div>

        <div class="field c2">
            <label>Código Diagnóstico (CIE10)</label>
            <input id="codigo_diagnostico" class="input @error('codigo_diagnostico') is-invalid @enderror" name="codigo_diagnostico" value="{{ old('codigo_diagnostico', $s->codigo_diagnostico ?? '') }}" autocomplete="off" placeholder="Ej: S72.0">
            <div id="cie10_msg" class="help"></div>
            @error('codigo_diagnostico')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c4">
            <label>Diagnóstico</label>
            <textarea id="diagnostico" class="textarea @error('diagnostico') is-invalid @enderror" name="diagnostico" readonly>{{ old('diagnostico', $s->diagnostico ?? '') }}</textarea>
            @error('diagnostico')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c2">
            <label>Código de Operación (CPT)</label>
            <input id="codigo_operacion" class="input @error('codigo_operacion') is-invalid @enderror" name="codigo_operacion" value="{{ old('codigo_operacion', $s->codigo_operacion ?? '') }}" autocomplete="off" placeholder="Ej: 27130">
            <div id="cpt_msg" class="help"></div>
            @error('codigo_operacion')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c4">
            <label>Operación</label>
            <textarea id="operacion" class="textarea @error('operacion') is-invalid @enderror" name="operacion" readonly>{{ old('operacion', $s->operacion ?? '') }}</textarea>
            @error('operacion')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c3">
            <label>Hto</label>
            <input class="input @error('hto') is-invalid @enderror" name="hto" value="{{ old('hto', $s->hto ?? '') }}">
            @error('hto')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c3">
            <label>Hb</label>
            <input class="input @error('hb') is-invalid @enderror" name="hb" value="{{ old('hb', $s->hb ?? '') }}">
            @error('hb')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c3">
            <label>GS</label>
            <input id="gs" class="input @error('gs') is-invalid @enderror" name="gs" value="{{ old('gs', $s->gs ?? '') }}">
            @error('gs')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c3">
            <label>Rh</label>
            <input id="rh" class="input @error('rh') is-invalid @enderror" name="rh" value="{{ old('rh', $s->rh ?? '') }}">
            @error('rh')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="divider"></div>

        <div class="field c6">
            <label>Cirujano Principal</label>
            <select class="select medico-select @error('cirujano_principal') is-invalid @enderror" name="cirujano_principal">
                <option value=""></option>
                @if(old('cirujano_principal', $s->cirujano_principal ?? ''))
                <option value="{{ old('cirujano_principal', $s->cirujano_principal ?? '') }}" selected>
                    {{ old('cirujano_principal', $s->cirujano_principal ?? '') }}
                </option>
                @endif
            </select>
            @error('cirujano_principal')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c6">
            <label>1er Ayudante</label>
            <input class="input @error('primer_ayudante') is-invalid @enderror" name="primer_ayudante" value="{{ old('primer_ayudante', $s->primer_ayudante ?? '') }}">
            @error('primer_ayudante')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c4">
            <label>2do Ayudante</label>
            <input class="input @error('segundo_ayudante') is-invalid @enderror" name="segundo_ayudante" value="{{ old('segundo_ayudante', $s->segundo_ayudante ?? '') }}">
            @error('segundo_ayudante')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c4">
            <label>3er Ayudante</label>
            <input class="input @error('tercer_ayudante') is-invalid @enderror" name="tercer_ayudante" value="{{ old('tercer_ayudante', $s->tercer_ayudante ?? '') }}">
            @error('tercer_ayudante')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c4">
            <label>Instrumentista</label>
            <input class="input @error('instrumentista') is-invalid @enderror" name="instrumentista" value="{{ old('instrumentista', $s->instrumentista ?? '') }}">
            @error('instrumentista')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="divider"></div>

        <div class="field c6">
            <label>Tiempo Operativo Aprox.</label>
            <input class="input @error('tiempo_operativo_aprox') is-invalid @enderror" name="tiempo_operativo_aprox" value="{{ old('tiempo_operativo_aprox', $s->tiempo_operativo_aprox ?? '') }}" placeholder="Ej: 01:30">
            @error('tiempo_operativo_aprox')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field c6">
            <label>Posición del Paciente</label>
            <input class="input @error('posicion_paciente') is-invalid @enderror" name="posicion_paciente" value="{{ old('posicion_paciente', $s->posicion_paciente ?? '') }}" placeholder="Ej: Decúbito supino">
            @error('posicion_paciente')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="divider"></div>

        <div class="programacion-box">
            <h3 class="programacion-title">Programación de Sala de Operaciones (Jefatura)</h3>
            <p class="programacion-sub">
                Estos campos serán asignados por la jefatura de sala al momento de confirmar y programar la intervención.
            </p>

            <div class="programacion-grid">
                <div class="field c4">
                    <label>Fecha Programada</label>
                    <input
                        class="input @error('fecha_programada') is-invalid @enderror"
                        type="date"
                        name="fecha_programada"
                        value="{{ old('fecha_programada', $s->fecha_programada ?? '') }}"
                        {{ $esEdicion ? '' : 'disabled' }}>

                    @error('fecha_programada')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field c4">
                    <label>Hora Programada</label>
                    <input
                        class="input @error('hora_programada') is-invalid @enderror"
                        type="time"
                        name="hora_programada"
                        value="{{ old('hora_programada', $s->hora_programada ?? '') }}"
                        {{ $esEdicion ? '' : 'disabled' }}>

                    @error('hora_programada')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field c4">
                    <label>Sala de Operación</label>
                    <select class="input @error('sala_operacion') is-invalid @enderror" name="sala_operacion" {{ $esEdicion ? '' : 'disabled' }}>
                        <option value="">-- Seleccione sala --</option>

                        @for($i = 1; $i <= 6; $i++)
                            @php
                            $sala='SALA ' . str_pad($i, 2, '0' , STR_PAD_LEFT);
                            @endphp

                            <option value="{{ $sala }}" {{ old('sala_operacion', $s->sala_operacion ?? '') == $sala ? 'selected' : '' }}>
                            {{ $sala }}
                            </option>
                            @endfor
                    </select>

                    @error('sala_operacion')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if(!$esEdicion)
            <div class="help">
                En el registro inicial estos campos permanecen bloqueados y vacíos.
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hc = document.getElementById('n_historia');
        const pac = document.getElementById('paciente');
        const edad = document.getElementById('edad');
        const msg = document.getElementById('hc_msg');
        const idp = document.getElementById('id_paciente_sigh');
        const gs = document.getElementById('gs');
        const rh = document.getElementById('rh');

        const cie10 = document.getElementById('codigo_diagnostico');
        const cie10Msg = document.getElementById('cie10_msg');
        const diagnostico = document.getElementById('diagnostico');

        const cpt = document.getElementById('codigo_operacion');
        const cptMsg = document.getElementById('cpt_msg');
        const operacion = document.getElementById('operacion');

        let tHC = null;
        let tCIE10 = null;
        let tCPT = null;

        function setMsg(el, text, cls = '') {
            el.textContent = text || '';
            el.classList.remove('ok', 'err');
            if (cls) el.classList.add(cls);
        }

        function clearHC(text = '', cls = '') {
            pac.value = '';
            edad.value = '';
            idp.value = '';
            if (gs) gs.value = '';
            if (rh) rh.value = '';
            setMsg(msg, text, cls);
        }

        function clearCIE10(text = '', cls = '') {
            diagnostico.value = '';
            setMsg(cie10Msg, text, cls);
        }

        function clearCPT(text = '', cls = '') {
            operacion.value = '';
            setMsg(cptMsg, text, cls);
        }

        if (hc) {
            hc.addEventListener('input', () => {
                clearTimeout(tHC);
                const val = hc.value.trim();

                if (!val || val.length < 2) {
                    clearHC('', '');
                    return;
                }

                setMsg(msg, 'Buscando paciente en SIGH...', '');

                tHC = setTimeout(async () => {
                    try {
                        const url = `{{ route('api.paciente.por_historia') }}?n_historia=${encodeURIComponent(val)}`;
                        const res = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!res.ok) {
                            clearHC('HC no encontrada.', 'err');
                            return;
                        }

                        const json = await res.json();

                        if (json.ok) {
                            pac.value = json.data.paciente ?? '';
                            edad.value = json.data.edad ?? '';
                            idp.value = json.data.id_paciente ?? '';
                            if (gs) gs.value = json.data.grupo_sanguineo ?? '';
                            if (rh) rh.value = json.data.factor_rh ?? '';
                            setMsg(msg, 'Paciente encontrado.', 'ok');
                        } else {
                            clearHC('HC no encontrada.', 'err');
                        }
                    } catch (e) {
                        clearHC('Error de conexión.', 'err');
                    }
                }, 300);
            });
        }

        if (cie10) {
            cie10.addEventListener('input', () => {
                clearTimeout(tCIE10);
                const val = cie10.value.trim();

                if (!val || val.length < 2) {
                    clearCIE10('', '');
                    return;
                }

                setMsg(cie10Msg, 'Buscando diagnóstico...', '');

                tCIE10 = setTimeout(async () => {
                    try {
                        const url = `{{ route('api.diagnostico.por_cie10') }}?codigo=${encodeURIComponent(val)}`;
                        const res = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!res.ok) {
                            clearCIE10('CIE10 no encontrado.', 'err');
                            return;
                        }

                        const json = await res.json();

                        if (json.ok) {
                            diagnostico.value = json.data.descripcion ?? '';
                            setMsg(cie10Msg, 'Diagnóstico encontrado.', 'ok');
                        } else {
                            clearCIE10('CIE10 no encontrado.', 'err');
                        }
                    } catch (e) {
                        clearCIE10('Error de conexión.', 'err');
                    }
                }, 300);
            });
        }

        if (cpt) {
            cpt.addEventListener('input', () => {
                clearTimeout(tCPT);
                const val = cpt.value.trim();

                if (!val || val.length < 2) {
                    clearCPT('', '');
                    return;
                }

                setMsg(cptMsg, 'Buscando operación...', '');

                tCPT = setTimeout(async () => {
                    try {
                        const url = `{{ route('api.operacion.por_cpt') }}?codigo=${encodeURIComponent(val)}`;
                        const res = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!res.ok) {
                            clearCPT('CPT no encontrado.', 'err');
                            return;
                        }

                        const json = await res.json();

                        if (json.ok) {
                            operacion.value = json.data.descripcion ?? '';
                            setMsg(cptMsg, 'Operación encontrada.', 'ok');
                        } else {
                            clearCPT('CPT no encontrado.', 'err');
                        }
                    } catch (e) {
                        clearCPT('Error de conexión.', 'err');
                    }
                }, 300);
            });
        }
    });

    $(document).ready(function() {
        const $medico = $('select[name="cirujano_principal"]');

        $medico.select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Escriba para buscar médico',
            allowClear: true,
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('api.medicos.buscar') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term || ''
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results || []
                    };
                },
                cache: true
            }
        });
    });
</script>