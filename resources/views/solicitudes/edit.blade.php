@extends('layouts.app')

@section('content')
<div class="or-page">
    <div class="or-container">
        <div class="or-head">
            <div>
                <h1 class="or-title">Editar Solicitud #{{ $solicitud->id }}</h1>
                <p class="or-sub">Actualiza los datos manteniendo coherencia con el registro clínico.</p>
            </div>
            <div class="or-actions">
                <a class="or-btn" href="{{ route('solicitudes.index') }}">Volver</a>
                <button form="solForm" class="or-btn or-btn-primary">Actualizar</button>
            </div>
        </div>

        <div class="or-panel">
            <div class="or-panel-head">
                <div class="label">Formulario</div>
                <div class="or-count">Edición</div>
            </div>

            <div class="or-panel-body">
                <form id="solForm" method="POST" action="{{ route('solicitudes.update', $solicitud) }}">
                    @csrf
                    @method('PUT')
                    @include('solicitudes._form', ['solicitud' => $solicitud])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection