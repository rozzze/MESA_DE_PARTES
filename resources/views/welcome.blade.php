<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Mesa de Partes Digital - IES Pedro P. Díaz</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />
    
    <style>
        /* Reset y Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-navy: #002D64;
            --primary-blue: #0F3D59;
            --accent-blue: #0477BF;
            --gold-dark: #B88900;
            --gold-light: #F2C84B;
            --bright-yellow: #F2CB05;
            --bright-red: #F20519;
            --dark-black: #0D0D0D;
            --pure-white: #FFFFFF;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(128deg, var(--primary-navy) 0%, var(--primary-blue) 60%, var(--accent-blue) 100%);
            position: relative;
        }

        /* Elementos decorativos de fondo más sutiles */
        .bg-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            z-index: 1;
        }

        .bg-decoration::before {
            content: '';
            position: absolute;
            top: -60%;
            right: -35%;
            width: 70%;
            height: 140%;
            background: radial-gradient(ellipse, rgba(242, 196, 75, 0.04) 0%, transparent 65%);
            border-radius: 60% 40% 30% 70%;
            transform: rotate(-15deg);
        }

        .bg-decoration::after {
            content: '';
            position: absolute;
            bottom: -45%;
            left: -30%;
            width: 65%;
            height: 110%;
            background: radial-gradient(ellipse, rgba(242, 203, 5, 0.03) 0%, transparent 60%);
            border-radius: 40% 60% 70% 30%;
            transform: rotate(25deg);
        }

        /* Header Navigation */
        .header {
            position: relative;
            z-index: 10;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--gold-light);
            border-radius: 25px;
            color: var(--gold-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gold-light);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .nav-btn:hover::before {
            left: 0;
        }

        .nav-btn:hover {
            color: var(--primary-navy);
        }

        .nav-btn.filled {
            background: var(--gold-light);
            color: var(--primary-navy);
        }

        .nav-btn.filled:hover {
            background: var(--bright-yellow);
        }

        /* Main Content Container */
        .main-container {
            position: relative;
            z-index: 5;
            height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .content-wrapper {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 850px;
            width: 100%;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        /* Logo más natural */
        .logo {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            border: 2px solid rgba(242, 196, 75, 0.6);
            box-shadow: 0 8px 25px rgba(242, 196, 75, 0.15);
            object-fit: cover;
        }

        /* Typography más natural */
        .main-title {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 1.2rem;
            background: linear-gradient(125deg, var(--gold-dark), var(--gold-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }

        .subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 1.8rem;
            font-weight: 400;
            line-height: 1.4;
        }

        .description {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2.5rem;
            font-weight: 400;
            line-height: 1.5;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .institute-name {
            color: var(--gold-light);
            font-weight: 700;
        }

        /* Botón principal más sutil */
        .main-btn {
            background: linear-gradient(120deg, var(--gold-dark), var(--gold-light));
            color: var(--pure-white);
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px rgba(184, 137, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .main-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 25px rgba(184, 137, 0, 0.35);
        }

        /* Características más simples */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 2.5rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 1.2rem;
            text-align: center;
        }

        .feature-icon {
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
            display: block;
        }

        .feature-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gold-light);
            margin-bottom: 0.4rem;
        }

        .feature-description {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.65);
            line-height: 1.3;
        }

        /* Footer */
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem 2rem;
            text-align: center;
            z-index: 10;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .nav-buttons {
                gap: 0.5rem;
            }

            .nav-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .main-container {
                height: calc(100vh - 100px);
                padding: 1rem;
            }

            .content-wrapper {
                padding: 2rem 1.5rem;
            }

            .logo {
                width: 80px;
                height: 80px;
            }

            .main-title {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.1rem;
            }

            .description {
                font-size: 1rem;
            }

            .main-btn {
                padding: 1rem 2rem;
                font-size: 1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 2rem;
            }

            .feature-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1rem;
            }

            .main-btn {
                padding: 0.9rem 1.5rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <!-- Fondo decorativo -->
    <div class="bg-decoration"></div>

    <!-- Header -->
    <header class="header">
        @if (Route::has('login'))
            <nav class="nav-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-btn">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-btn filled">Registrarse</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Contenido Principal -->
    <main class="main-container">
        <div class="content-wrapper">
            <!-- Logo -->
            <img src="{{ asset('img/ppdlogo.png') }}" alt="Logo Instituto Pedro P. Díaz" class="logo">

            <!-- Título Principal -->
            <h1 class="main-title">Mesa de Partes Digital</h1>

            <!-- Subtítulo -->
            <p class="subtitle">
                Plataforma digital para la gestión académica del<br>
                <span class="institute-name">Instituto de Educación Superior Tecnológico Público "Pedro P. Díaz"</span>
            </p>

            <!-- Descripción -->
            <p class="description">
                Gestiona tus trámites, consulta información académica y mantente conectado con nuestra comunidad educativa de manera rápida y segura.
            </p>

            <!-- Botón Principal -->
            <a href="{{ route('login') }}" class="main-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Acceder al Sistema
            </a>

            <!-- Características -->
            <div class="features-grid">
                <div class="feature-card">
                    <span class="feature-icon">⚡</span>
                    <h3 class="feature-title">Rápido</h3>
                    <p class="feature-description">Procesos optimizados</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">🔒</span>
                    <h3 class="feature-title">Seguro</h3>
                    <p class="feature-description">Información protegida</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">📱</span>
                    <h3 class="feature-title">Accesible</h3>
                    <p class="feature-description">Disponible siempre</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p class="footer-text">
            ©️ {{ date('Y') }} Instituto de Educación Superior Tecnológico Público "Pedro P. Díaz" - Todos los derechos reservados
        </p>
    </footer>
</body>
</html>