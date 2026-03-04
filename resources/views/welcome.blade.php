<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AppBelen') }} | Acceso</title>

    <style>
        :root{
            --bg0:#061218;
            --bg1:#0a1d28;
            --panel: rgba(12, 40, 56, .62);
            --panel2: rgba(12, 40, 56, .35);
            --line: rgba(255,255,255,.12);

            --text:#eaf3f8;
            --muted: rgba(234,243,248,.72);

            --primary:#2bd4c5;   /* verde quirófano */
            --primary2:#1bb3f2;  /* azul clínico */
            --ok:#39d98a;

            --shadow: 0 18px 60px rgba(0,0,0,.45);
            --shadow2: 0 10px 30px rgba(0,0,0,.28);
            --radius: 18px;
        }

        *{ box-sizing:border-box; }
        html,body{ height:100%; }
        body{
            margin:0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
            color:var(--text);
            background:
                radial-gradient(1100px 650px at 12% 10%, rgba(43,212,197,.16), transparent 60%),
                radial-gradient(900px 520px at 90% 15%, rgba(27,179,242,.14), transparent 55%),
                radial-gradient(650px 420px at 65% 85%, rgba(57,217,138,.10), transparent 60%),
                linear-gradient(180deg, var(--bg0), var(--bg1));
            overflow-x:hidden;
        }

        .glow{
            position:fixed;
            inset:-200px;
            pointer-events:none;
            background: radial-gradient(circle at 40% 25%, rgba(43,212,197,.16), transparent 45%);
            filter: blur(36px);
            opacity:.85;
        }
        .grid{
            position:fixed;
            inset:0;
            pointer-events:none;
            opacity:.18;
            background-image:
                linear-gradient(to right, rgba(255,255,255,.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 52px 52px;
            mask-image: radial-gradient(circle at 40% 30%, black 0%, transparent 66%);
        }

        .wrap{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding: 28px 0;
            position:relative;
        }

        .container{
            width: min(1050px, 92vw);
            display:grid;
            grid-template-columns: 1.1fr .9fr;
            gap:18px;
        }
        @media (max-width: 980px){
            .container{ grid-template-columns: 1fr; }
        }

        .left{
            border:1px solid var(--line);
            border-radius: var(--radius);
            background:
                radial-gradient(900px 420px at 18% 20%, rgba(43,212,197,.14), transparent 55%),
                radial-gradient(700px 420px at 85% 30%, rgba(27,179,242,.12), transparent 55%),
                linear-gradient(180deg, rgba(12,40,56,.78), rgba(12,40,56,.40));
            box-shadow: var(--shadow);
            padding: 26px;
            position:relative;
            overflow:hidden;
            backdrop-filter: blur(10px);
        }
        .left::after{
            content:"";
            position:absolute;
            inset:-1px;
            background: radial-gradient(circle at 70% 8%, rgba(255,255,255,.10), transparent 42%);
            pointer-events:none;
        }

        .topline{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
        }

        .brand{
            display:flex;
            gap:12px;
            align-items:center;
        }
        .logo{
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
        .brand-title{
            margin:0;
            font-size: 13px;
            letter-spacing:.6px;
            font-weight: 800;
            text-transform: uppercase;
        }
        .brand-sub{
            margin:2px 0 0;
            color:var(--muted);
            font-size: 12px;
        }

        .status{
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
        .dot{
            width:10px;height:10px;border-radius:999px;
            background: var(--ok);
            box-shadow: 0 0 0 6px rgba(57,217,138,.12);
        }

        .hero-title{
            margin: 18px 0 10px;
            font-size: 38px;
            line-height: 1.06;
            letter-spacing: -.6px;
        }
        .hero-desc{
            margin:0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            max-width: 68ch;
        }

        .features{
            margin-top: 18px;
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:10px;
        }
        @media (max-width: 520px){
            .features{ grid-template-columns: 1fr; }
            .hero-title{ font-size: 32px; }
        }

        .feat{
            border:1px solid var(--line);
            border-radius: 16px;
            background: rgba(12,40,56,.35);
            padding: 12px 12px;
        }
        .feat .k{
            display:flex;
            align-items:center;
            gap:8px;
            font-size: 12px;
            color: rgba(234,243,248,.88);
            font-weight: 700;
            margin-bottom: 6px;
        }
        .chip{
            width:10px;height:10px;border-radius:999px;
            background: var(--primary);
            box-shadow: 0 0 0 6px rgba(43,212,197,.10);
        }
        .chip.blue{ background: var(--primary2); box-shadow: 0 0 0 6px rgba(27,179,242,.10); }
        .feat .v{
            font-size: 12.5px;
            color: var(--muted);
            line-height: 1.6;
        }

        .right{
            border:1px solid var(--line);
            border-radius: var(--radius);
            background: linear-gradient(180deg, rgba(12,40,56,.60), rgba(12,40,56,.28));
            box-shadow: var(--shadow2);
            padding: 22px;
            backdrop-filter: blur(10px);
        }

        .right h3{
            margin:0 0 8px;
            font-size: 14px;
            letter-spacing: .2px;
        }
        .right p{
            margin:0 0 14px;
            color: var(--muted);
            font-size: 12.5px;
            line-height: 1.6;
        }

        .actions{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .btn{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            width:100%;
            padding: 12px 14px;
            border-radius: 14px;
            border:1px solid var(--line);
            background: rgba(12,40,56,.35);
            color: var(--text);
            text-decoration:none;
            font-size: 13px;
            font-weight: 700;
            transition: transform .15s ease, border-color .15s ease, background .15s ease;
        }
        .btn:hover{
            transform: translateY(-1px);
            background: rgba(12,40,56,.55);
            border-color: rgba(27,179,242,.45);
        }
        .btn-primary{
            border-color: rgba(43,212,197,.60);
            background: linear-gradient(135deg, rgba(43,212,197,.18), rgba(27,179,242,.14));
        }
        .btn-primary:hover{
            border-color: rgba(43,212,197,.90);
        }

        .divider{
            display:flex;
            align-items:center;
            gap:10px;
            margin: 14px 0;
            color: rgba(234,243,248,.55);
            font-size: 12px;
        }
        .divider::before, .divider::after{
            content:"";
            height:1px;
            background: var(--line);
            flex:1;
        }

        .legal{
            margin-top: 10px;
            color: rgba(234,243,248,.55);
            font-size: 12px;
            line-height: 1.5;
        }
        .legal a{
            color: rgba(234,243,248,.75);
            text-decoration:none;
        }
        .legal a:hover{ text-decoration:underline; }

        .footer{
            margin-top: 16px;
            display:flex;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:10px;
            color: rgba(234,243,248,.55);
            font-size: 12px;
        }

        a:focus{
            outline:3px solid rgba(43,212,197,.35);
            outline-offset:2px;
            border-radius: 12px;
        }
    </style>
</head>
<body>
<div class="glow"></div>
<div class="grid"></div>

<div class="wrap">
    <main class="container" aria-label="Landing de acceso">
        <!-- LEFT: Identidad + mensaje institucional -->
        <section class="left">
            <div class="topline">
                <div class="brand">
                    <div class="logo" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M10 4h4v6h6v4h-6v6h-4v-6H4v-4h6V4z" fill="rgba(255,255,255,.92)"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="brand-title">Hospital Belen de Trujillo</h1>
                        <p class="brand-sub">Acceso institucional • Sala de Operaciones</p>
                    </div>
                </div>

                <div class="status" title="Estado del sistema">
                    <span class="dot" aria-hidden="true"></span>
                    Operativo • Acceso seguro
                </div>
            </div>

            <h2 class="hero-title">Sistema Sala de Operaciones - HBT</h2>
            <p class="hero-desc">
                Plataforma para gestión clínica y operativa: control de accesos, registro y trazabilidad.
                Diseñada para un entorno hospitalario con enfoque en seguridad, auditoría y estandarización de procesos.
            </p>

            <div class="features" aria-label="Características">
                <div class="feat">
                    <div class="k"><span class="chip" aria-hidden="true"></span> Seguridad y control</div>
                    <div class="v">Acceso por credenciales, roles y sesiones protegidas.</div>
                </div>
                <div class="feat">
                    <div class="k"><span class="chip blue" aria-hidden="true"></span> Trazabilidad</div>
                    <div class="v">Registro ordenado para auditoría y seguimiento operativo.</div>
                </div>
            </div>

            <div class="footer">
                <span>© {{ date('Y') }} HBT</span>
                <span>Entorno hospitalario • Uso autorizado</span>
            </div>
        </section>

        <!-- RIGHT: Accesos -->
        <aside class="right" aria-label="Panel de acceso">
            <h3>Ingresar al sistema</h3>
            <p>Selecciona una opción para autenticarte. Si no tienes cuenta, solicita registro al administrador.</p>

            <div class="actions">
                @if (Route::has('login'))
                    @auth
                        <a class="btn btn-primary" href="{{ url('/dashboard') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 13h7V4H4v9zm0 7h7v-5H4v5zm9 0h7V11h-7v9zm0-18v7h7V2h-7z" fill="rgba(234,243,248,.9)"/>
                            </svg>
                            Ir al Dashboard
                        </a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M10 17l1.4-1.4-2.6-2.6H20v-2H8.8l2.6-2.6L10 7l-5 5 5 5z" fill="rgba(234,243,248,.9)"/>
                            </svg>
                            Iniciar sesión
                        </a>

                        @if (Route::has('register'))
                            <a class="btn" href="{{ route('register') }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M15 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zM5 20v-1c0-2.8 4.7-4 7-4 .4 0 .8 0 1.2.1-1.3 1-2.2 2.3-2.2 3.9V20H5zm14 0v-2h-2v-2h2v-2h2v2h2v2h-2v2h-2z" fill="rgba(234,243,248,.9)"/>
                                </svg>
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="divider">Información</div>

            <div class="legal">
                <div><strong>Nota:</strong> Este sistema es para uso institucional. Cualquier acceso es monitoreado.</div>
                <div style="margin-top:8px;">
                    ¿Problemas de acceso? <a href="#">Contactar soporte</a>
                </div>
            </div>
        </aside>
    </main>
</div>
</body>
</html>