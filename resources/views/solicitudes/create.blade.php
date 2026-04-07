@extends('layouts.app')

@section('content')
<div class="or-page">
    <div class="or-container">
        <div class="or-head">
            <div>
                <h1 class="or-title">Nueva Solicitud</h1>
                <p class="or-sub">Completa el formulario según el formato físico de Solicitud de Sala de Operaciones.</p>
            </div>
            <div class="or-actions">
                <a class="or-btn" href="{{ route('solicitudes.index') }}">Volver</a>
                <button form="solForm" class="or-btn or-btn-primary">Guardar</button>
            </div>
        </div>

        <div class="or-panel">
            <div class="or-panel-head">
                <div class="label">Formulario</div>
                <div class="or-count">Registro</div>
            </div>

            <div class="or-panel-body">
                <form id="solForm" method="POST" action="{{ route('solicitudes.store') }}">
                    @csrf
                    @include('solicitudes._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection