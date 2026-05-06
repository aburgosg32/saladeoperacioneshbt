@extends('layouts.app')
@section('title', 'SOP-HBT | Acceso')

@section('content')
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
        --ok: #39d98a;
        --danger: #ff6b6b;

        --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        --shadow2: 0 10px 30px rgba(0, 0, 0, .28);
        --radius: 18px;
    }

    .or-auth-wrap {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 28px 0;
        color: var(--text);
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .16), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .14), transparent 55%),
            radial-gradient(650px 420px at 65% 85%, rgba(57, 217, 138, .10), transparent 60%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        overflow: hidden;
        position: relative;
    }

    .or-auth-glow {
        position: absolute;
        inset: -220px;
        pointer-events: none;
        background: radial-gradient(circle at 40% 25%, rgba(43, 212, 197, .16), transparent 45%);
        filter: blur(36px);
        opacity: .85;
    }

    .or-auth-grid {
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: .18;
        background-image:
            linear-gradient(to right, rgba(255, 255, 255, .05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, .05) 1px, transparent 1px);
        background-size: 52px 52px;
        mask-image: radial-gradient(circle at 40% 30%, black 0%, transparent 66%);
    }

    .or-auth-container {
        width: min(1180px, 94vw);
        display: grid;
        grid-template-columns: 1.2fr .8fr;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    @media (max-width: 980px) {
        .or-auth-container {
            grid-template-columns: 1fr;
        }
    }

    .or-left {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43, 212, 197, .14), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27, 179, 242, .12), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        padding: 30px;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .or-left::after {
        content: "";
        position: absolute;
        inset: -1px;
        background: radial-gradient(circle at 70% 8%, rgba(255, 255, 255, .10), transparent 42%);
        pointer-events: none;
    }

    .or-brand {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .or-brand-main {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .or-logos-box {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 18px 26px;
        border-radius: 24px;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, .98), rgba(245, 248, 250, .96));
        border: 1px solid rgba(255, 255, 255, .28);
        box-shadow:
            0 18px 40px rgba(0, 0, 0, .28),
            inset 0 1px 0 rgba(255, 255, 255, .65);
        width: fit-content;
    }

    .or-logo-gore {
        height: 105px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .or-logo-hbt {
        height: 95px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .or-logo-divider {
        width: 1px;
        height: 78px;
        background: rgba(6, 18, 24, .18);
    }

    .or-title {
        margin: 0;
        font-size: 25px;
        letter-spacing: .6px;
        font-weight: 900;
        text-transform: uppercase;
        color: var(--text);
    }

    .or-sub {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.5;
    }

    .or-status {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .35);
        color: var(--muted);
        font-size: 13px;
        width: fit-content;
    }

    .or-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--ok);
        box-shadow: 0 0 0 6px rgba(57, 217, 138, .12);
    }

    .or-hero {
        margin-top: 26px;
        position: relative;
        z-index: 1;
    }

    .or-hero h2 {
        margin: 0 0 12px;
        font-size: 44px;
        line-height: 1.06;
        letter-spacing: -.7px;
    }

    .or-hero p {
        margin: 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.8;
        max-width: 70ch;
    }

    .or-note {
        margin-top: 20px;
        border: 1px solid var(--line);
        border-radius: 16px;
        background: rgba(12, 40, 56, .35);
        padding: 14px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    .or-features {
        margin-top: 18px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        position: relative;
        z-index: 1;
    }

    .or-feature {
        border: 1px solid var(--line);
        border-radius: 16px;
        background: rgba(12, 40, 56, .35);
        padding: 14px;
    }

    .or-feature-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(234, 243, 248, .88);
        font-weight: 800;
        margin-bottom: 6px;
    }

    .or-chip {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--primary);
        box-shadow: 0 0 0 6px rgba(43, 212, 197, .10);
    }

    .or-chip.blue {
        background: var(--primary2);
        box-shadow: 0 0 0 6px rgba(27, 179, 242, .10);
    }

    .or-feature-text {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    .or-right {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background: linear-gradient(180deg, rgba(12, 40, 56, .60), rgba(12, 40, 56, .28));
        box-shadow: var(--shadow2);
        padding: 28px;
        backdrop-filter: blur(10px);
    }

    .or-right h3 {
        margin: 0 0 8px;
        font-size: 20px;
        letter-spacing: .2px;
    }

    .or-right .hint {
        margin: 0 0 18px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .or-form {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .or-field label {
        display: block;
        margin-bottom: 7px;
        font-size: 12.5px;
        color: rgba(234, 243, 248, .88);
        font-weight: 800;
    }

    .or-input {
        width: 100%;
        padding: 13px 14px;
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .28);
        color: var(--text);
        outline: none;
        transition: border-color .15s ease, background .15s ease, transform .15s ease;
    }

    .or-input::placeholder {
        color: rgba(234, 243, 248, .45);
    }

    .or-input:focus {
        border-color: rgba(43, 212, 197, .75);
        background: rgba(12, 40, 56, .40);
    }

    .or-error {
        margin-top: 6px;
        color: rgba(255, 107, 107, .95);
        font-size: 12px;
        font-weight: 700;
    }

    .or-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 2px;
    }

    .or-check {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--muted);
        font-size: 12.5px;
    }

    .or-check input {
        width: 16px;
        height: 16px;
        accent-color: var(--primary);
    }

    .or-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 13px 15px;
        border-radius: 14px;
        border: 1px solid rgba(43, 212, 197, .60);
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
        color: var(--text);
        text-decoration: none;
        font-size: 14px;
        font-weight: 900;
        cursor: pointer;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
    }

    .or-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(43, 212, 197, .90);
    }

    .or-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 18px 0 0;
        color: rgba(234, 243, 248, .55);
        font-size: 12px;
    }

    .or-divider::before,
    .or-divider::after {
        content: "";
        height: 1px;
        background: var(--line);
        flex: 1;
    }

    .or-legal {
        margin-top: 14px;
        color: rgba(234, 243, 248, .55);
        font-size: 12px;
        line-height: 1.6;
    }

    @media (max-width: 680px) {
        .or-auth-wrap {
            padding: 18px 0;
        }

        .or-left,
        .or-right {
            padding: 20px;
        }

        .or-logos-box {
            width: 100%;
            justify-content: center;
            gap: 14px;
            padding: 14px;
        }

        .or-logo-gore {
            height: 72px;
        }

        .or-logo-hbt {
            height: 66px;
        }

        .or-logo-divider {
            height: 54px;
        }

        .or-title {
            font-size: 20px;
        }

        .or-sub {
            font-size: 13px;
        }

        .or-hero h2 {
            font-size: 34px;
        }

        .or-features {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="or-auth-wrap">
    <div class="or-auth-glow"></div>
    <div class="or-auth-grid"></div>

    <div class="or-auth-container">

        <section class="or-left">
            <div class="or-brand">

                <div class="or-brand-main">

                    <div class="or-logos-box">
                        <img src="{{ asset('img/logogerencia.png') }}"
                            alt="Gobierno Regional La Libertad"
                            class="or-logo-gore">

                        <div class="or-logo-divider"></div>

                        <img src="{{ asset('img/logo.png') }}"
                            alt="Hospital Belén de Trujillo"
                            class="or-logo-hbt">
                    </div>

                    <div>
                        <h1 class="or-title">Hospital Belén de Trujillo</h1>
                        <p class="or-sub">Gobierno Regional La Libertad • Sistema Sala de Operaciones</p>
                    </div>

                </div>

                <div class="or-status">
                    <span class="or-dot" aria-hidden="true"></span>
                    Autenticación segura
                </div>

            </div>

            <div class="or-hero">
                <h2>Ingreso al sistema</h2>
                <p>
                    Acceso autorizado para personal clínico y administrativo del Hospital Belén de Trujillo.
                    El sistema permite gestionar, monitorear y auditar los procesos de Sala de Operaciones.
                </p>
            </div>

            <div class="or-features">
                <div class="or-feature">
                    <div class="or-feature-title">
                        <span class="or-chip"></span>
                        Control institucional
                    </div>
                    <div class="or-feature-text">
                        Acceso mediante usuario autorizado, roles y sesiones protegidas.
                    </div>
                </div>

                <div class="or-feature">
                    <div class="or-feature-title">
                        <span class="or-chip blue"></span>
                        Auditoría operativa
                    </div>
                    <div class="or-feature-text">
                        Registro de actividad y trazabilidad de operaciones quirúrgicas.
                    </div>
                </div>
            </div>

            <div class="or-note">
                <strong>Recomendación:</strong> utiliza únicamente tus credenciales institucionales.
                No compartas tu contraseña. Ante problemas de acceso, comunícate con el Área de Informática HBT.
            </div>
        </section>

        <aside class="or-right">
            <h3>Credenciales de acceso</h3>
            <p class="hint">Ingresa tu DNI y contraseña para continuar.</p>

            <form method="POST" action="{{ route('login') }}" class="or-form" novalidate>
                @csrf

                <div class="or-field">
                    <label for="email">DNI</label>

                    <input
                        id="email"
                        type="text"
                        class="or-input @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Ingrese su DNI">

                    @error('email')
                    <div class="or-error" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="or-field">
                    <label for="password">Contraseña</label>

                    <input
                        id="password"
                        type="password"
                        class="or-input @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingrese su contraseña">

                    @error('password')
                    <div class="or-error" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="or-row">
                    <label class="or-check" for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Recordarme
                    </label>
                </div>

                <button type="submit" class="or-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M10 17l1.4-1.4-2.6-2.6H20v-2H8.8l2.6-2.6L10 7l-5 5 5 5z" fill="rgba(234,243,248,.9)" />
                    </svg>
                    Iniciar sesión
                </button>

                <div class="or-divider">Información</div>

                <div class="or-legal">
                    © {{ date('Y') }} Hospital Belén de Trujillo • Acceso monitoreado • Uso autorizado.
                </div>
            </form>
        </aside>

    </div>
</div>
@endsection