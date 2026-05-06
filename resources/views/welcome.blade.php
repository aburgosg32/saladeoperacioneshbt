<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AppBelen') }} | Acceso</title>

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

            --shadow: 0 18px 60px rgba(0, 0, 0, .45);
            --shadow2: 0 10px 30px rgba(0, 0, 0, .28);
            --radius: 18px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
            color: var(--text);
            background:
                radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .16), transparent 60%),
                radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .14), transparent 55%),
                radial-gradient(650px 420px at 65% 85%, rgba(57, 217, 138, .10), transparent 60%),
                linear-gradient(180deg, var(--bg0), var(--bg1));
            overflow-x: hidden;
        }

        .glow {
            position: fixed;
            inset: -200px;
            pointer-events: none;
            background: radial-gradient(circle at 40% 25%, rgba(43, 212, 197, .16), transparent 45%);
            filter: blur(36px);
            opacity: .85;
        }

        .grid {
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .18;
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, .05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, .05) 1px, transparent 1px);
            background-size: 52px 52px;
            mask-image: radial-gradient(circle at 40% 30%, black 0%, transparent 66%);
        }

        .wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 0;
            position: relative;
        }

        .container {
            width: min(1180px, 94vw);
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 20px;
        }

        @media (max-width: 980px) {
            .container {
                grid-template-columns: 1fr;
            }
        }

        .left {
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

        .left::after {
            content: "";
            position: absolute;
            inset: -1px;
            background: radial-gradient(circle at 70% 8%, rgba(255, 255, 255, .10), transparent 42%);
            pointer-events: none;
        }

        .topline {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
        }

        .brand {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .brand-logos-box {
            display: flex;
            align-items: center;
            gap: 24px;

            padding: 18px 26px;

            border-radius: 24px;

            background:
                linear-gradient(180deg,
                    rgba(255, 255, 255, .98),
                    rgba(245, 248, 250, .96));

            border: 1px solid rgba(255, 255, 255, .28);

            box-shadow:
                0 18px 40px rgba(0, 0, 0, .28),
                inset 0 1px 0 rgba(255, 255, 255, .65);

            width: fit-content;
        }

        .brand-logo-gore {
            height: 110px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .brand-logo-hbt {
            height: 100px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .brand-divider {
            width: 1px;
            height: 82px;
            background: rgba(6, 18, 24, .18);
        }

        .brand-title {
            margin: 0;
            font-size: 26px;
            letter-spacing: .6px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .brand-sub {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.5;
        }

        .status {
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

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--ok);
            box-shadow: 0 0 0 6px rgba(57, 217, 138, .12);
        }

        .hero-title {
            margin: 26px 0 12px;
            font-size: 46px;
            line-height: 1.05;
            letter-spacing: -.8px;
        }

        .hero-desc {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.8;
            max-width: 70ch;
        }

        .features {
            margin-top: 22px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        @media (max-width: 520px) {
            .features {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 34px;
            }

            .brand-logo-gore {
                height: 70px;
            }

            .brand-logo-hbt {
                height: 64px;
            }

            .brand-divider {
                height: 56px;
            }

            .brand-title {
                font-size: 20px;
            }
        }

        .feat {
            border: 1px solid var(--line);
            border-radius: 16px;
            background: rgba(12, 40, 56, .35);
            padding: 14px;
        }

        .feat .k {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: rgba(234, 243, 248, .88);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .chip {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--primary);
            box-shadow: 0 0 0 6px rgba(43, 212, 197, .10);
        }

        .chip.blue {
            background: var(--primary2);
            box-shadow: 0 0 0 6px rgba(27, 179, 242, .10);
        }

        .feat .v {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        .right {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: linear-gradient(180deg, rgba(12, 40, 56, .60), rgba(12, 40, 56, .28));
            box-shadow: var(--shadow2);
            padding: 28px;
            backdrop-filter: blur(10px);
        }

        .right h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        .right p {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid var(--line);
            background: rgba(12, 40, 56, .35);
            color: var(--text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: transform .15s ease, border-color .15s ease, background .15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            background: rgba(12, 40, 56, .55);
            border-color: rgba(27, 179, 242, .45);
        }

        .btn-primary {
            border-color: rgba(43, 212, 197, .60);
            background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
        }

        .btn-primary:hover {
            border-color: rgba(43, 212, 197, .90);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 18px 0;
            color: rgba(234, 243, 248, .55);
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            background: var(--line);
            flex: 1;
        }

        .legal {
            margin-top: 10px;
            color: rgba(234, 243, 248, .55);
            font-size: 12px;
            line-height: 1.7;
        }

        .footer {
            margin-top: 24px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            color: rgba(234, 243, 248, .55);
            font-size: 12px;
        }

        a:focus {
            outline: 3px solid rgba(43, 212, 197, .35);
            outline-offset: 2px;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="glow"></div>
    <div class="grid"></div>

    <div class="wrap">
        <main class="container" aria-label="Landing de acceso">

            <section class="left">

                <div class="topline">

                    <div class="brand">

                        <div class="brand-logos-box">

                            <img src="{{ asset('img/logogerencia.png') }}"
                                alt="Gobierno Regional La Libertad"
                                class="brand-logo-gore">

                            <div class="brand-divider"></div>

                            <img src="{{ asset('img/logo.png') }}"
                                alt="Hospital Belén de Trujillo"
                                class="brand-logo-hbt">

                        </div>

                        <div>
                            <h1 class="brand-title">
                                Hospital Belén de Trujillo
                            </h1>

                            <p class="brand-sub">
                                Gobierno Regional La Libertad • Sistema Sala de Operaciones
                            </p>
                        </div>

                    </div>

                    <div class="status" title="Estado del sistema">
                        <span class="dot" aria-hidden="true"></span>
                        Operativo • Acceso seguro
                    </div>

                </div>

                <h2 class="hero-title">
                    Sistema Sala de Operaciones - HBT
                </h2>

                <p class="hero-desc">
                    Plataforma institucional para gestión clínica y operativa de procedimientos quirúrgicos.
                    Diseñada para control, monitoreo y trazabilidad en entorno hospitalario,
                    garantizando seguridad, auditoría y seguimiento en tiempo real.
                </p>

                <div class="features">

                    <div class="feat">
                        <div class="k">
                            <span class="chip"></span>
                            Seguridad y control
                        </div>

                        <div class="v">
                            Acceso protegido mediante credenciales institucionales y control por roles.
                        </div>
                    </div>

                    <div class="feat">
                        <div class="k">
                            <span class="chip blue"></span>
                            Trazabilidad clínica
                        </div>

                        <div class="v">
                            Seguimiento integral de procedimientos quirúrgicos y operaciones registradas.
                        </div>
                    </div>

                </div>

                <div class="footer">
                    <span>© {{ date('Y') }} Hospital Belén de Trujillo</span>
                    <span>Uso institucional autorizado</span>
                </div>

            </section>

            <aside class="right" aria-label="Panel de acceso">

                <h3>Ingresar al sistema</h3>

                <p>
                    Selecciona una opción para autenticarte.
                    Si no cuentas con acceso, comunícate con el Área de Informática.
                </p>

                <div class="actions">

                    @if (Route::has('login'))

                    @auth

                    <a class="btn btn-primary" href="{{ url('/home') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M4 13h7V4H4v9zm0 7h7v-5H4v5zm9 0h7V11h-7v9zm0-18v7h7V2h-7z"
                                fill="rgba(234,243,248,.9)" />
                        </svg>

                        Ir al Home
                    </a>

                    @else

                    <a class="btn btn-primary" href="{{ route('login') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M10 17l1.4-1.4-2.6-2.6H20v-2H8.8l2.6-2.6L10 7l-5 5 5 5z"
                                fill="rgba(234,243,248,.9)" />
                        </svg>

                        Iniciar sesión
                    </a>

                    @endauth

                    @endif

                </div>

                <div class="divider">
                    Información institucional
                </div>

                <div class="legal">

                    <div>
                        <strong>Nota:</strong>
                        Este sistema es de uso exclusivo del Hospital Belén de Trujillo.
                        Todo acceso y operación realizada es registrada y monitoreada.
                    </div>

                    <div style="margin-top:10px;">
                        Soporte técnico y accesos:
                        Área de Informática HBT
                    </div>

                </div>

            </aside>

        </main>
    </div>

</body>

</html>