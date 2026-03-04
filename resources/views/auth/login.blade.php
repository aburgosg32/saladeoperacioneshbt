@extends('layouts.app')

@section('content')
<style>
    :root{
        --bg0:#061218;
        --bg1:#0a1d28;
        --panel: rgba(12, 40, 56, .62);
        --panel2: rgba(12, 40, 56, .35);
        --line: rgba(255,255,255,.12);

        --text:#eaf3f8;
        --muted: rgba(234,243,248,.72);

        --primary:#2bd4c5;
        --primary2:#1bb3f2;
        --ok:#39d98a;

        --shadow: 0 18px 60px rgba(0,0,0,.45);
        --shadow2: 0 10px 30px rgba(0,0,0,.28);
        --radius: 18px;
    }

    /* Fondo general solo para esta vista */
    .or-auth-wrap{
        min-height: calc(100vh - 80px);
        display:flex;
        align-items:center;
        justify-content:center;
        padding: 28px 0;
        color: var(--text);
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43,212,197,.16), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27,179,242,.14), transparent 55%),
            radial-gradient(650px 420px at 65% 85%, rgba(57,217,138,.10), transparent 60%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        overflow:hidden;
        position: relative;
    }

    .or-auth-glow{
        position:absolute;
        inset:-220px;
        pointer-events:none;
        background: radial-gradient(circle at 40% 25%, rgba(43,212,197,.16), transparent 45%);
        filter: blur(36px);
        opacity:.85;
    }
    .or-auth-grid{
        position:absolute;
        inset:0;
        pointer-events:none;
        opacity:.18;
        background-image:
            linear-gradient(to right, rgba(255,255,255,.05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255,255,255,.05) 1px, transparent 1px);
        background-size: 52px 52px;
        mask-image: radial-gradient(circle at 40% 30%, black 0%, transparent 66%);
    }

    .or-auth-container{
        width: min(980px, 92vw);
        display:grid;
        grid-template-columns: 1.1fr .9fr;
        gap: 18px;
        position: relative;
        z-index: 1;
    }

    @media (max-width: 980px){
        .or-auth-container{ grid-template-columns: 1fr; }
    }

    .or-left{
        border:1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43,212,197,.14), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27,179,242,.12), transparent 55%),
            linear-gradient(180deg, rgba(12,40,56,.78), rgba(12,40,56,.40));
        box-shadow: var(--shadow);
        padding: 26px;
        position: relative;
        overflow:hidden;
        backdrop-filter: blur(10px);
    }
    .or-left::after{
        content:"";
        position:absolute;
        inset:-1px;
        background: radial-gradient(circle at 70% 8%, rgba(255,255,255,.10), transparent 42%);
        pointer-events:none;
    }

    .or-brand{
        display:flex;
        gap: 12px;
        align-items:center;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .or-brand-main{
        display:flex;
        gap: 12px;
        align-items:center;
    }
    .or-logo{
        width:44px;height:44px;
        border-radius: 16px;
        display:grid;
        place-items:center;
        background:
            radial-gradient(circle at 30% 30%, rgba(255,255,255,.22), transparent 35%),
            linear-gradient(135deg, rgba(43,212,197,.95), rgba(27,179,242,.85));
        border:1px solid rgba(255,255,255,.18);
        box-shadow: 0 12px 26px rgba(0,0,0,.25);
    }
    .or-title{
        margin:0;
        font-size: 13px;
        letter-spacing:.6px;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--text);
    }
    .or-sub{
        margin:2px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    .or-status{
        display:inline-flex;
        align-items:center;
        gap:10px;
        padding:8px 12px;
        border-radius: 999px;
        border:1px solid var(--line);
        background: rgba(12,40,56,.35);
        color: var(--muted);
        font-size: 12px;
        width: fit-content;
    }
    .or-dot{
        width:10px;height:10px;border-radius:999px;
        background: var(--ok);
        box-shadow: 0 0 0 6px rgba(57,217,138,.12);
    }

    .or-hero{
        margin-top: 16px;
    }
    .or-hero h2{
        margin: 0 0 10px;
        font-size: 34px;
        line-height: 1.06;
        letter-spacing: -.6px;
    }
    .or-hero p{
        margin:0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
        max-width: 70ch;
    }

    .or-note{
        margin-top: 16px;
        border:1px solid var(--line);
        border-radius: 16px;
        background: rgba(12,40,56,.35);
        padding: 12px 12px;
        color: var(--muted);
        font-size: 12.5px;
        line-height: 1.6;
    }

    .or-right{
        border:1px solid var(--line);
        border-radius: var(--radius);
        background: linear-gradient(180deg, rgba(12,40,56,.60), rgba(12,40,56,.28));
        box-shadow: var(--shadow2);
        padding: 22px;
        backdrop-filter: blur(10px);
    }

    .or-right h3{
        margin:0 0 6px;
        font-size: 14px;
        letter-spacing: .2px;
    }
    .or-right .hint{
        margin:0 0 14px;
        color: var(--muted);
        font-size: 12.5px;
        line-height: 1.6;
    }

    /* Inputs */
    .or-form{
        display:flex;
        flex-direction: column;
        gap: 12px;
    }

    .or-field label{
        display:block;
        margin-bottom: 6px;
        font-size: 12px;
        color: rgba(234,243,248,.88);
        font-weight: 700;
    }

    .or-input{
        width:100%;
        padding: 12px 12px;
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12,40,56,.28);
        color: var(--text);
        outline: none;
        transition: border-color .15s ease, background .15s ease, transform .15s ease;
    }
    .or-input::placeholder{ color: rgba(234,243,248,.45); }
    .or-input:focus{
        border-color: rgba(43,212,197,.75);
        background: rgba(12,40,56,.40);
    }

    .or-error{
        margin-top: 6px;
        color: rgba(255,107,107,.95);
        font-size: 12px;
        font-weight: 600;
    }

    .or-row{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 2px;
    }

    .or-check{
        display:flex;
        align-items:center;
        gap: 10px;
        color: var(--muted);
        font-size: 12.5px;
    }
    .or-check input{
        width: 16px;
        height: 16px;
        accent-color: var(--primary);
    }

    .or-btn{
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        width:100%;
        padding: 12px 14px;
        border-radius: 14px;
        border:1px solid rgba(43,212,197,.60);
        background: linear-gradient(135deg, rgba(43,212,197,.18), rgba(27,179,242,.14));
        color: var(--text);
        text-decoration:none;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
    }
    .or-btn:hover{
        transform: translateY(-1px);
        border-color: rgba(43,212,197,.90);
    }

    .or-link{
        color: rgba(234,243,248,.80);
        text-decoration:none;
        font-size: 12.5px;
        border:1px solid var(--line);
        background: rgba(12,40,56,.25);
        padding: 10px 12px;
        border-radius: 14px;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
        display:inline-flex;
        align-items:center;
        gap: 8px;
    }
    .or-link:hover{
        transform: translateY(-1px);
        border-color: rgba(27,179,242,.45);
        background: rgba(12,40,56,.45);
    }

    .or-divider{
        display:flex;
        align-items:center;
        gap: 10px;
        margin: 14px 0 0;
        color: rgba(234,243,248,.55);
        font-size: 12px;
    }
    .or-divider::before, .or-divider::after{
        content:"";
        height:1px;
        background: var(--line);
        flex:1;
    }

    .or-legal{
        margin-top: 12px;
        color: rgba(234,243,248,.55);
        font-size: 12px;
        line-height: 1.5;
    }
</style>

<div class="or-auth-wrap">
    <div class="or-auth-glow"></div>
    <div class="or-auth-grid"></div>

    <div class="or-auth-container">
        <!-- Panel izquierda -->
        <section class="or-left">
            <div class="or-brand">
                <div class="or-brand-main">
                    <div class="or-logo" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M10 4h4v6h6v4h-6v6h-4v-6H4v-4h6V4z" fill="rgba(255,255,255,.92)"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="or-title">Hospital Belen de Trujillo</h1>
                        <p class="or-sub">Acceso institucional • Sala de Operaciones</p>
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
                    Inicia sesión con tu cuenta autorizada. Este acceso está destinado a personal clínico y administrativo.
                    Todas las actividades quedan registradas para auditoría.
                </p>
            </div>

            <div class="or-note">
                <strong>Recomendación:</strong> usa credenciales institucionales y evita compartir tu contraseña.
                Si olvidaste tu clave, utiliza la opción de recuperación.
            </div>
        </section>

        <!-- Panel derecha: formulario -->
        <aside class="or-right">
            <h3>Credenciales</h3>
            <p class="hint">Ingresa tu correo y contraseña para continuar.</p>

            <form method="POST" action="{{ route('login') }}" class="or-form" novalidate>
                @csrf

                <div class="or-field">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input
                        id="email"
                        type="email"
                        class="or-input @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="usuario@hospital.com"
                    >
                    @error('email')
                        <div class="or-error" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="or-field">
                    <label for="password">{{ __('Password') }}</label>
                    <input
                        id="password"
                        type="password"
                        class="or-input @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••••"
                    >
                    @error('password')
                        <div class="or-error" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="or-row">
                    <label class="or-check" for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a class="or-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="or-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M10 17l1.4-1.4-2.6-2.6H20v-2H8.8l2.6-2.6L10 7l-5 5 5 5z" fill="rgba(234,243,248,.9)"/>
                    </svg>
                    {{ __('Login') }}
                </button>

                @if (Route::has('register'))
                    <div class="or-divider">o</div>
                    <a class="or-link" href="{{ route('register') }}" style="justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M15 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zM5 20v-1c0-2.8 4.7-4 7-4 .4 0 .8 0 1.2.1-1.3 1-2.2 2.3-2.2 3.9V20H5zm14 0v-2h-2v-2h2v-2h2v2h2v2h-2v2h-2z" fill="rgba(234,243,248,.9)"/>
                        </svg>
                        Crear cuenta / Registrarse
                    </a>
                @endif

                <div class="or-legal">
                    © {{ date('Y') }} HBT • Acceso monitoreado • Uso autorizado
                </div>
            </form>
        </aside>
    </div>
</div>
@endsection