<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | ShopDAI</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&family=Instrument+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --void: #050507; --neon: #7fff6e; --amber: #ffb347;
            --ink: #f0f0f5; --ink2: rgba(240,240,245,0.6); --ink3: rgba(240,240,245,0.3);
            --danger: #ff5f6d; --glass: rgba(255,255,255,0.04); --glass-bd: rgba(255,255,255,0.08);
            --border: rgba(255,255,255,0.07);
        }
        html, body { height: 100%; font-family: 'Instrument Sans', sans-serif; background: var(--void); color: var(--ink); }
        body { display: grid; grid-template-columns: 1.1fr 0.9fr; min-height: 100vh; overflow: hidden; }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 15% 30%, rgba(127,255,110,0.07) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 85% 75%, rgba(168,216,255,0.05) 0%, transparent 50%);
            pointer-events: none; z-index: 0;
        }

        /* LEFT */
        .panel-left {
            position: relative; z-index: 1;
            background: rgba(10,10,15,0.6);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            justify-content: space-between;
            padding: 3.5rem; overflow: hidden;
        }
        .panel-left::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(127,255,110,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(127,255,110,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridFloat 20s linear infinite;
        }
        @keyframes gridFloat { from { background-position: 0 0; } to { background-position: 60px 60px; } }
        .panel-left::after {
            content: '';
            position: absolute; top: -100px; left: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(127,255,110,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .left-top { position: relative; z-index: 2; }
        .logo {
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 2.5rem;
            letter-spacing: -0.04em; color: var(--ink);
            display: flex; align-items: center; gap: 0.6rem; margin-bottom: 2.5rem;
        }
        .logo .dot {
            width: 12px; height: 12px; background: var(--neon); border-radius: 50%;
            box-shadow: 0 0 20px rgba(127,255,110,0.6);
            animation: blink 2.5s ease-in-out infinite;
        }
        @keyframes blink {
            0%,100% { opacity:1; box-shadow: 0 0 20px rgba(127,255,110,0.6); }
            50%      { opacity:0.4; box-shadow: 0 0 8px rgba(127,255,110,0.2); }
        }
        .tagline { font-size: 1.5rem; font-weight: 400; line-height: 1.5; color: var(--ink2); max-width: 400px; margin-bottom: 2rem; }
        .tagline strong { color: var(--ink); font-weight: 600; }
        .feature-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .feature-item { display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; color: var(--ink3); }
        .feature-item::before { content: ''; width: 6px; height: 6px; background: var(--neon); border-radius: 50%; flex-shrink: 0; box-shadow: 0 0 8px rgba(127,255,110,0.5); }
        .left-bottom { position: relative; z-index: 2; font-family: 'Space Mono', monospace; font-size: 0.62rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--ink3); }

        /* RIGHT */
        .panel-right {
            position: relative; z-index: 1;
            display: flex; align-items: center; justify-content: center;
            padding: 3rem; background: rgba(5,5,7,0.5);
        }
        .login-box { width: 100%; max-width: 380px; animation: fadeUp 0.6s ease both; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        .login-box h2 { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.9rem; letter-spacing: -0.03em; color: var(--ink); margin-bottom: 0.4rem; }
        .login-box .sub { color: var(--ink3); font-size: 0.85rem; margin-bottom: 2.25rem; }

        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; font-family: 'Space Mono', monospace; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--ink3); margin-bottom: 0.5rem; }
        .form-group input {
            width: 100%; padding: 0.75rem 1rem;
            background: var(--glass); border: 1px solid var(--glass-bd);
            border-radius: 10px; font-size: 0.92rem; color: var(--ink);
            font-family: 'Instrument Sans', sans-serif; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input::placeholder { color: var(--ink3); }
        .form-group input:focus { outline: none; border-color: rgba(127,255,110,0.5); box-shadow: 0 0 0 3px rgba(127,255,110,0.08); }

        .alert-danger  { background: rgba(255,95,109,0.08); border: 1px solid rgba(255,95,109,0.2);  color: var(--danger); padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 1.25rem; font-size: 0.85rem; }
        .alert-success { background: rgba(127,255,110,0.08); border: 1px solid rgba(127,255,110,0.2); color: var(--neon);   padding: 0.8rem 1rem; border-radius: 10px; margin-bottom: 1.25rem; font-size: 0.85rem; }

        .btn-login {
            width: 100%; padding: 0.88rem;
            background: var(--ink); color: var(--void);
            border: none; border-radius: 10px;
            font-size: 0.85rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase;
            cursor: pointer; font-family: 'Instrument Sans', sans-serif;
            transition: all 0.25s; margin-top: 0.5rem;
        }
        .btn-login:hover { background: #fff; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(240,240,245,0.2); }

        .divider { height: 1px; background: var(--border); margin: 1.75rem 0; }
        .credenciales { background: var(--glass); border: 1px solid var(--border); border-radius: 10px; padding: 1rem 1.2rem; }
        .cred-title { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--ink3); margin-bottom: 0.65rem; }
        .cred-row { display: flex; align-items: center; justify-content: space-between; padding: 0.4rem 0; font-size: 0.78rem; color: var(--ink2); border-bottom: 1px solid rgba(255,255,255,0.04); }
        .cred-row:last-child { border-bottom: none; }
        code { font-family: 'Space Mono', monospace; font-size: 0.72rem; background: rgba(255,255,255,0.06); padding: 0.15rem 0.5rem; border-radius: 5px; color: var(--ink2); }
    </style>
</head>
<body>

<div class="panel-left">
    <div class="left-top">
        <div class="logo"><span class="dot"></span>ShopDAI</div>
        <p class="tagline">Tu plataforma de gestión de<br><strong>productos y catálogos</strong><br>para DAI Ciclo III.</p>
        <div class="feature-list">
            <div class="feature-item">Galería visual de productos con filtros</div>
            <div class="feature-item">Gestión de categorías y stock</div>
            <div class="feature-item">Carrito de compras en tiempo real</div>
        </div>
    </div>
    <div class="left-bottom">Desarrollo de Aplicaciones en Internet &mdash; {{ date('Y') }}</div>
</div>

<div class="panel-right">
    <div class="login-box">
        <h2>Bienvenido</h2>
        <p class="sub">Ingresa tus credenciales para continuar</p>

        @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert-danger">{{ $errors->first() }}</div>@endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com" required autofocus>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión →</button>
        </form>

        <div class="divider"></div>
        <div class="credenciales">
            <div class="cred-title">Credenciales de prueba</div>
            <div class="cred-row"><span>Admin</span><code>admin@productosapp.com / admin123</code></div>
            <div class="cred-row" style="border-bottom:none;"><span>Demo</span><code>demo@productosapp.com / demo123</code></div>
        </div>
    </div>
</div>
</body>
</html>