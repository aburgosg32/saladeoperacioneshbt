@extends('layouts.app')

@section('content')
<style>
    .or-dash-wrap{
        min-height: calc(100vh - 80px);
        padding: 28px 0;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43,212,197,.10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27,179,242,.10), transparent 55%),
            linear-gradient(180deg, #061218, #0a1d28);
        color: #eaf3f8;
    }
    .or-dash-container{
        width: min(1100px, 92vw);
        margin: 0 auto;
    }
    .or-title{
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 6px;
    }
    .or-sub{
        margin: 0 0 18px;
        color: rgba(234,243,248,.72);
        font-size: 13px;
    }
    .or-grid{
        display:grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
    @media (max-width: 900px){
        .or-grid{ grid-template-columns: 1fr; }
    }
    .or-card{
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 18px;
        background: rgba(12,40,56,.55);
        padding: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,.25);
    }
    .or-card h4{
        margin: 0 0 6px;
        font-size: 14px;
        font-weight: 800;
    }
    .or-card p{
        margin: 0;
        color: rgba(234,243,248,.72);
        font-size: 12.5px;
        line-height: 1.6;
    }
</style>

<div class="or-dash-wrap">
    <div class="or-dash-container">
        <h1 class="or-title">Dashboard • Sala de Operaciones</h1>
        <p class="or-sub">
            Bienvenido, <strong>{{ Auth::user()->name }}</strong>. Selecciona un módulo para comenzar.
        </p>

        <div class="or-grid">
            <div class="or-card">
                <h4>Pacientes</h4>
                <p>Registro y búsqueda de pacientes, datos básicos y seguimiento.</p>
            </div>

            <div class="or-card">
                <h4>Cirugías</h4>
                <p>Programación, estado, procedimientos y trazabilidad.</p>
            </div>

            <div class="or-card">
                <h4>Personal y turnos</h4>
                <p>Equipo médico, roles, guardias y asignaciones.</p>
            </div>
        </div>
    </div>
</div>
@endsection