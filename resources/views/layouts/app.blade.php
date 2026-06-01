<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ShopDAI') | DAI</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&family=Instrument+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --void:       #050507;
            --deep:       #0a0a0f;
            --surface:    #0f0f18;
            --glass:      rgba(255,255,255,0.04);
            --glass-bd:   rgba(255,255,255,0.08);
            --neon:       #7fff6e;
            --neon-dim:   rgba(127,255,110,0.12);
            --neon-glow:  0 0 20px rgba(127,255,110,0.35);
            --amber:      #ffb347;
            --amber-dim:  rgba(255,179,71,0.12);
            --ice:        #a8d8ff;
            --ink:        #f0f0f5;
            --ink2:       rgba(240,240,245,0.6);
            --ink3:       rgba(240,240,245,0.3);
            --danger:     #ff5f6d;
            --success:    #7fff6e;
            --warn:       #ffb347;
            --radius:     12px;
            --radius-lg:  20px;
            --border:     rgba(255,255,255,0.07);
            --shadow:     0 8px 32px rgba(0,0,0,0.5);
            --shadow-lg:  0 20px 60px rgba(0,0,0,0.7);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: var(--void);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(127,255,110,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 90% 90%, rgba(168,216,255,0.05) 0%, transparent 50%),
                radial-gradient(ellipse 40% 30% at 50% 50%, rgba(255,179,71,0.03) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.5;
        }

        a { color: inherit; text-decoration: none; }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--void); }
        ::-webkit-scrollbar-thumb { background: var(--glass-bd); border-radius: 2px; }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2.5rem;
            height: 64px;
            background: rgba(5,5,7,0.85);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-bottom: 1px solid var(--border);
        }
        .navbar .brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar .brand .dot {
            width: 8px; height: 8px;
            background: var(--neon);
            border-radius: 50%;
            box-shadow: var(--neon-glow);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(0.7); }
        }
        .navbar nav { display: flex; align-items: center; gap: 0.15rem; }
        .navbar nav a {
            color: var(--ink2);
            padding: 0.45rem 1rem;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .navbar nav a:hover { color: var(--ink); background: var(--glass); }
        .nav-pill {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--neon-dim);
            border: 1px solid rgba(127,255,110,0.25);
            color: var(--neon) !important;
            padding: 0.45rem 1.1rem !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            transition: all 0.25s !important;
        }
        .nav-pill:hover {
            background: rgba(127,255,110,0.2) !important;
            box-shadow: var(--neon-glow) !important;
        }
        .nav-pill .count {
            background: var(--neon);
            color: var(--void);
            font-size: 0.65rem;
            font-weight: 800;
            width: 18px; height: 18px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-logout {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--ink3);
            padding: 0.45rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.82rem;
            font-family: 'Instrument Sans', sans-serif;
            transition: all 0.2s;
            margin-left: 0.5rem;
        }
        .btn-logout:hover { border-color: rgba(255,95,109,0.4); color: var(--danger); background: rgba(255,95,109,0.06); }

        /* ── LAYOUT ── */
        .main-content {
            position: relative;
            z-index: 1;
            max-width: 1320px;
            margin: 0 auto;
            padding: 2.5rem 2rem 6rem;
        }

        /* ── GLASS CARD ── */
        .card {
            background: var(--glass);
            border: 1px solid var(--glass-bd);
            border-radius: var(--radius-lg);
            padding: 2rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.4rem;
            border-radius: 9px;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            border: none;
            transition: all 0.22s;
            font-family: 'Instrument Sans', sans-serif;
            letter-spacing: 0.02em;
            white-space: nowrap;
        }
        .btn-primary { background: var(--ink); color: var(--void); }
        .btn-primary:hover { background: #fff; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(240,240,245,0.2); color: var(--void); text-decoration: none; }
        .btn-success { background: var(--neon-dim); color: var(--neon); border: 1px solid rgba(127,255,110,0.25); }
        .btn-success:hover { background: rgba(127,255,110,0.2); box-shadow: var(--neon-glow); color: var(--neon); text-decoration: none; transform: translateY(-1px); }
        .btn-danger { background: rgba(255,95,109,0.08); color: var(--danger); border: 1px solid rgba(255,95,109,0.2); }
        .btn-danger:hover { background: rgba(255,95,109,0.15); color: var(--danger); text-decoration: none; }
        .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--ink2); }
        .btn-outline:hover { border-color: var(--glass-bd); background: var(--glass); color: var(--ink); text-decoration: none; }
        .btn-sm { padding: 0.4rem 0.9rem; font-size: 0.74rem; }
        .btn[disabled], .btn-disabled { opacity: 0.3; cursor: not-allowed; pointer-events: none; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .page-header h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 2.4rem;
            letter-spacing: -0.03em;
            color: var(--ink);
            line-height: 1;
        }
        .count-tag {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            font-weight: 400;
            color: var(--neon);
            background: var(--neon-dim);
            border: 1px solid rgba(127,255,110,0.2);
            padding: 0.15rem 0.6rem;
            border-radius: 20px;
            margin-left: 0.75rem;
            vertical-align: middle;
            letter-spacing: 0.05em;
        }

        /* ── TOOLBAR ── */
        .toolbar { display: flex; gap: 0.75rem; margin-bottom: 2rem; flex-wrap: wrap; align-items: center; }
        .toolbar input, .toolbar select {
            padding: 0.6rem 1rem;
            background: var(--glass);
            border: 1px solid var(--glass-bd);
            border-radius: 9px;
            color: var(--ink);
            font-size: 0.85rem;
            font-family: 'Instrument Sans', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            backdrop-filter: blur(8px);
        }
        .toolbar input { flex: 1; min-width: 200px; }
        .toolbar input::placeholder { color: var(--ink3); }
        .toolbar select option { background: #0f0f18; }
        .toolbar input:focus, .toolbar select:focus { outline: none; border-color: rgba(127,255,110,0.4); box-shadow: 0 0 0 3px rgba(127,255,110,0.08); }

        /* ── PRODUCT GALLERY ── */
        .galeria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 1.25rem;
        }
        .producto-card {
            background: var(--glass);
            border: 1px solid var(--glass-bd);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            backdrop-filter: blur(8px);
        }
        .producto-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(127,255,110,0.15);
            border-color: rgba(127,255,110,0.2);
        }
        .producto-card .img-wrap { position: relative; overflow: hidden; background: rgba(255,255,255,0.02); }
        .producto-card img { width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.5s; filter: brightness(0.9) saturate(1.1); }
        .producto-card:hover img { transform: scale(1.06); filter: brightness(1) saturate(1.2); }
        .producto-card .no-foto {
            width: 100%; height: 220px;
            display: flex; align-items: center; justify-content: center;
            color: var(--ink3);
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem; letter-spacing: 0.1em;
            background: repeating-linear-gradient(45deg, rgba(255,255,255,0.01) 0px, rgba(255,255,255,0.01) 1px, transparent 1px, transparent 20px);
        }
        .img-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, transparent 50%, rgba(5,5,7,0.8) 100%); }
        .badge-float { position: absolute; top: 12px; left: 12px; }
        .producto-card .card-body { padding: 1.25rem 1.25rem 0.75rem; flex-grow: 1; display: flex; flex-direction: column; gap: 0.4rem; }
        .cat-label { font-family: 'Space Mono', monospace; font-size: 0.64rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--amber); }
        .producto-card h3 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.05rem; color: var(--ink); line-height: 1.25; letter-spacing: -0.01em; }
        .marca { color: var(--ink3); font-size: 0.78rem; }
        .precio { font-family: 'Space Mono', monospace; font-size: 1.25rem; font-weight: 700; color: var(--ink); margin-top: auto; padding-top: 0.75rem; }
        .precio span { font-size: 0.75rem; color: var(--ink3); }
        .producto-card .card-footer { padding: 0.85rem 1.25rem; border-top: 1px solid var(--border); display: flex; gap: 0.5rem; align-items: center; justify-content: space-between; }

        /* ── BADGES ── */
        .badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.2rem 0.65rem; border-radius: 20px;
            font-size: 0.66rem; font-weight: 700;
            letter-spacing: 0.06em; text-transform: uppercase;
            font-family: 'Space Mono', monospace;
        }
        .badge-ok      { background: rgba(127,255,110,0.12); color: var(--neon);   border: 1px solid rgba(127,255,110,0.2); }
        .badge-warn    { background: rgba(255,179,71,0.12);  color: var(--amber);  border: 1px solid rgba(255,179,71,0.2); }
        .badge-low     { background: rgba(255,95,109,0.1);   color: var(--danger); border: 1px solid rgba(255,95,109,0.2); }
        .badge-agotado { background: rgba(255,255,255,0.06); color: var(--ink2);   border: 1px solid var(--border); }
        .badge-cat     { background: rgba(255,179,71,0.1);   color: var(--amber);  border: 1px solid rgba(255,179,71,0.2); }

        /* ── TABLES ── */
        .table-wrap { border-radius: var(--radius-lg); border: 1px solid var(--border); overflow: hidden; background: var(--glass); backdrop-filter: blur(12px); }
        table { width: 100%; border-collapse: collapse; }
        th {
            background: rgba(255,255,255,0.03);
            color: var(--ink3);
            padding: 0.85rem 1.2rem;
            text-align: left;
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            border-bottom: 1px solid var(--border);
        }
        td { padding: 0.95rem 1.2rem; border-bottom: 1px solid rgba(255,255,255,0.04); font-size: 0.88rem; color: var(--ink2); vertical-align: middle; }
        td strong { color: var(--ink); }
        tr:last-child td { border-bottom: none; }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover td { background: rgba(255,255,255,0.025); }

        /* ── ALERTS ── */
        .alert { padding: 0.9rem 1.25rem; border-radius: 10px; margin-bottom: 1.25rem; font-size: 0.86rem; display: flex; align-items: center; gap: 0.6rem; }
        .alert-success { background: rgba(127,255,110,0.08); border: 1px solid rgba(127,255,110,0.2); color: var(--neon); }
        .alert-success::before { content: '✓'; }
        .alert-danger  { background: rgba(255,95,109,0.08);  border: 1px solid rgba(255,95,109,0.2);  color: var(--danger); }
        .alert-danger::before  { content: '✕'; }
        .alert-info    { background: rgba(255,179,71,0.08);  border: 1px solid rgba(255,179,71,0.2);  color: var(--amber); }
        .alert-info::before    { content: '◆'; }

        /* ── FORMS ── */
        .form-group { margin-bottom: 1.35rem; }
        .form-group label { display: block; font-family: 'Space Mono', monospace; font-weight: 700; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--ink3); margin-bottom: 0.5rem; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 0.7rem 1rem;
            background: var(--glass); border: 1px solid var(--glass-bd);
            border-radius: 9px; font-size: 0.9rem; color: var(--ink);
            font-family: 'Instrument Sans', sans-serif; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input::placeholder { color: var(--ink3); }
        .form-group select option { background: #0f0f18; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: rgba(127,255,110,0.5); box-shadow: 0 0 0 3px rgba(127,255,110,0.08); }
        .form-error { color: var(--danger); font-size: 0.78rem; margin-top: 0.35rem; }

        /* ── STAT CARDS ── */
        .stat-card { background: var(--glass); border: 1px solid var(--glass-bd); border-radius: var(--radius-lg); padding: 1.75rem; position: relative; overflow: hidden; transition: transform 0.25s, box-shadow 0.25s; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
        .stat-card .stat-value { font-family: 'Syne', sans-serif; font-size: 3.5rem; font-weight: 800; line-height: 1; margin-bottom: 0.4rem; }
        .stat-card .stat-label { font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; opacity: 0.5; }
        .stat-card .stat-glow { position: absolute; top: -40px; right: -40px; width: 150px; height: 150px; border-radius: 50%; filter: blur(40px); opacity: 0.15; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 5rem 2rem; color: var(--ink3); }
        .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
        .empty-state p { font-size: 0.9rem; margin-bottom: 1.5rem; }

        /* ── FOOTER ── */
        .site-footer { position: relative; z-index: 1; text-align: center; padding: 2.5rem; color: var(--ink3); font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.08em; text-transform: uppercase; border-top: 1px solid var(--border); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up   { animation: fadeUp 0.5s ease both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.12s; }
        .fade-up-3 { animation-delay: 0.19s; }
        .fade-up-4 { animation-delay: 0.26s; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <a href="{{ route('home') }}" class="brand">
        <span class="dot"></span>
        ShopDAI
    </a>
    <div style="display:flex; align-items:center; gap:0.15rem;">
        @auth
            @php
                $totalItems = \App\Models\Carrito::where('user_id', Auth::id())->sum('cantidad');
            @endphp
            <nav style="display:flex; align-items:center; gap:0.15rem;">
                <a href="{{ route('productos.galeria') }}">Galería</a>
                <a href="{{ route('productos.index') }}">Productos</a>
                <a href="{{ route('categorias.index') }}">Categorías</a>
                <a href="{{ route('carrito.index') }}" class="nav-pill" style="margin-left:0.5rem;">
                    🛒 Carrito
                    @if($totalItems > 0)
                        <span class="count">{{ $totalItems }}</span>
                    @endif
                </a>
            </nav>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Salir</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="color:var(--ink2); padding:0.45rem 1rem; border-radius:8px; font-size:0.82rem; transition:all 0.2s;">
                Iniciar sesión
            </a>
        @endauth
    </div>
</nav>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success fade-up">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger fade-up">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info fade-up">{{ session('info') }}</div>
    @endif

    @yield('contenido')
</div>

<footer class="site-footer">
    Desarrollo de Aplicaciones en Internet &mdash; Ciclo III &mdash; {{ date('Y') }}
</footer>

@stack('scripts')
</body>
</html>