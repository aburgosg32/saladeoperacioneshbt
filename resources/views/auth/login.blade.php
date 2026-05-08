@extends('layouts.app')
@section('title', 'SOP-HBT | Acceso')

@section('content')
<style>
    :root {
        --bg0: #eef4f2;
        --bg1: #f8fbfa;

        --panel: rgba(255, 255, 255, .88);
        --panel2: rgba(255, 255, 255, .72);
        --line: rgba(25, 64, 72, .12);

        --text: #20313a;
        --muted: #6f7f86;

        --primary: #35c89f;
        --primary2: #0f8f9f;
        --ok: #2fbe8f;

        --shadow: 0 22px 60px rgba(35, 64, 70, .14);
        --shadow2: 0 10px 30px rgba(35, 64, 70, .10);
        --radius: 22px;
    }

    .or-auth-wrap {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 28px 0;
        color: var(--text);

        background:
            radial-gradient(900px 520px at 12% 12%, rgba(53, 200, 159, .20), transparent 58%),
            radial-gradient(900px 520px at 92% 18%, rgba(15, 143, 159, .14), transparent 55%),
            linear-gradient(135deg, #eef4f2 0%, #f8fbfa 48%, #eaf2f0 100%);

        overflow: hidden;
        position: relative;
    }

    .or-auth-glow {
        position: absolute;
        inset: -220px;
        pointer-events: none;
        background:
            radial-gradient(circle at 40% 25%, rgba(53, 200, 159, .18), transparent 42%),
            radial-gradient(circle at 70% 80%, rgba(15, 143, 159, .10), transparent 44%);
        filter: blur(28px);
        opacity: .9;
    }

    .or-auth-grid {
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: .30;

        background-image:
            linear-gradient(to right, rgba(25, 64, 72, .07) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(25, 64, 72, .07) 1px, transparent 1px);

        background-size: 46px 46px;

        mask-image: radial-gradient(circle at 42% 30%, black 0%, transparent 68%);
    }

    .or-auth-container {
        width: min(1180px, 94vw);
        display: grid;
        grid-template-columns: 1.15fr .85fr;
        gap: 22px;
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
            radial-gradient(700px 360px at 18% 14%, rgba(53, 200, 159, .13), transparent 55%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));

        box-shadow: var(--shadow);

        padding: 32px;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(14px);
    }

    .or-left::after {
        content: "";
        position: absolute;
        inset: -1px;

        background:
            radial-gradient(circle at 72% 8%, rgba(53, 200, 159, .18), transparent 38%),
            linear-gradient(120deg, rgba(255, 255, 255, .45), transparent 40%);

        pointer-events: none;
    }

    .or-brand,
    .or-hero,
    .or-note {
        position: relative;
        z-index: 1;
    }

    .or-brand {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        flex-wrap: wrap;
    }

    .or-brand-main {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .or-logos-box {
        display: flex;
        align-items: center;
        gap: 24px;

        padding: 18px 26px;

        border-radius: 24px;

        background: linear-gradient(180deg, #ffffff, #f7faf9);

        border: 1px solid rgba(25, 64, 72, .10);

        box-shadow:
            0 18px 40px rgba(35, 64, 70, .12),
            inset 0 1px 0 rgba(255, 255, 255, .75);

        width: fit-content;
    }

    .or-logo-gore {
        height: 100px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .or-logo-hbt {
        height: 92px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    .or-divider-logo {
        width: 1px;
        height: 76px;
        background: rgba(25, 64, 72, .16);
    }

    .or-title {
        margin: 0;
        font-size: 26px;
        letter-spacing: .4px;
        font-weight: 900;
        text-transform: uppercase;
        color: #17313b;
    }

    .or-sub {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.5;
        font-weight: 600;
    }

    .or-status {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 999px;

        border: 1px solid rgba(53, 200, 159, .24);

        background: rgba(53, 200, 159, .10);

        color: #227e70;

        font-size: 13px;
        font-weight: 800;
        width: fit-content;
    }

    .or-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--ok);
        box-shadow: 0 0 0 6px rgba(47, 190, 143, .15);
    }

    .or-hero {
        margin-top: 28px;
    }

    .or-hero h2 {
        margin: 0 0 12px;
        font-size: 44px;
        line-height: 1.05;
        letter-spacing: -.8px;
        color: #172f3a;
    }

    .or-hero p {
        margin: 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.8;
        max-width: 70ch;
    }

    .or-note {
        margin-top: 22px;

        border: 1px solid rgba(25, 64, 72, .10);

        border-radius: 18px;

        background: rgba(255, 255, 255, .68);

        padding: 16px;

        color: var(--muted);

        font-size: 13px;
        line-height: 1.7;

        box-shadow: 0 8px 24px rgba(35, 64, 70, .07);
    }

    .or-right {
        border: 1px solid var(--line);
        border-radius: var(--radius);

        background:
            linear-gradient(180deg, rgba(255, 255, 255, .92), rgba(255, 255, 255, .74));

        box-shadow: var(--shadow2);

        padding: 30px;

        backdrop-filter: blur(14px);
    }

    .or-right h3 {
        margin: 0 0 8px;
        font-size: 22px;
        color: #17313b;
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
        font-size: 12px;
        color: #29414a;
        font-weight: 800;
        letter-spacing: .3px;
    }

    .or-input {
        width: 100%;
        padding: 14px 14px;

        border-radius: 16px;

        border: 1px solid rgba(25, 64, 72, .10);

        background: rgba(255, 255, 255, .88);

        color: #20313a;

        outline: none;

        font-size: 14px;

        transition: .18s ease;
    }

    .or-input::placeholder {
        color: rgba(32, 49, 58, .45);
    }

    .or-input:focus {
        border-color: rgba(53, 200, 159, .55);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .10);
    }

    .or-error {
        margin-top: 6px;
        color: #d64d4d;
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

        padding: 15px 16px;

        border-radius: 16px;

        border: 1px solid rgba(53, 200, 159, .44);

        background: linear-gradient(135deg, #35c89f, #13a889);

        color: #ffffff;

        font-size: 14px;
        font-weight: 800;

        cursor: pointer;

        box-shadow: 0 12px 26px rgba(53, 200, 159, .24);

        transition: .18s ease;
    }

    .or-btn:hover {
        transform: translateY(-1px);

        border-color: rgba(19, 168, 137, .70);

        background: linear-gradient(135deg, #39d6aa, #0f9f83);
    }

    .or-legal {
        margin-top: 16px;
        color: #6f7f86;
        font-size: 12px;
        line-height: 1.7;
    }

    @media (max-width: 520px) {

        .or-hero h2 {
            font-size: 34px;
        }

        .or-logo-gore {
            height: 70px;
        }

        .or-logo-hbt {
            height: 64px;
        }

        .or-divider-logo {
            height: 56px;
        }

        .or-title {
            font-size: 20px;
        }
    }
</style>

<div class="or-auth-wrap">

    <div class="or-auth-glow"></div>
    <div class="or-auth-grid"></div>

    <div class="or-auth-container">

        <!-- PANEL IZQUIERDO -->
        <section class="or-left">

            <div class="or-brand">

                <div class="or-brand-main">

                    <div class="or-logos-box">

                        <img src="{{ asset('img/logogerencia.png') }}"
                            alt="Gobierno Regional La Libertad"
                            class="or-logo-gore">

                        <div class="or-divider-logo"></div>

                        <img src="{{ asset('img/logo.png') }}"
                            alt="Hospital Belén de Trujillo"
                            class="or-logo-hbt">

                    </div>

                    <div>
                        <h1 class="or-title">
                            Hospital Belén de Trujillo
                        </h1>

                        <p class="or-sub">
                            Gobierno Regional La Libertad • Sistema Sala de Operaciones
                        </p>
                    </div>

                </div>

                <div class="or-status">
                    <span class="or-dot"></span>
                    Autenticación segura
                </div>

            </div>

            <div class="or-hero">

                <h2>
                    Ingreso al sistema
                </h2>

                <p>
                    Plataforma institucional orientada al control y gestión operativa
                    de procedimientos quirúrgicos. El acceso está restringido a
                    personal autorizado del Hospital Belén de Trujillo.
                </p>

            </div>

            <div class="or-note">

                <strong>Recomendación:</strong>
                utiliza únicamente credenciales institucionales.
                Todas las operaciones realizadas dentro del sistema
                son registradas y auditadas.

            </div>

        </section>

        <!-- PANEL DERECHO -->
        <aside class="or-right">

            <h3>Credenciales de acceso</h3>

            <p class="hint">
                Ingresa tu DNI y contraseña institucional para continuar.
            </p>

            <form method="POST"
                action="{{ route('login') }}"
                class="or-form"
                novalidate>

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
                    <div class="or-error">{{ $message }}</div>
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
                        placeholder="••••••••••">

                    @error('password')
                    <div class="or-error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="or-row">

                    <label class="or-check" for="remember">

                        <input type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        Recordar sesión

                    </label>

                </div>

                <button type="submit" class="or-btn">

                    <svg width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none">

                        <path d="M10 17l1.4-1.4-2.6-2.6H20v-2H8.8l2.6-2.6L10 7l-5 5 5 5z"
                            fill="currentColor" />

                    </svg>

                    Iniciar sesión

                </button>

                <div class="or-legal">
                    © {{ date('Y') }} Hospital Belén de Trujillo • Uso institucional autorizado
                </div>

            </form>

        </aside>

    </div>

</div>
@endsection