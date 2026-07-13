<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UAB')</title>
    <style>
        :root { color-scheme: dark; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: radial-gradient(circle at top left, rgba(255,69,69,0.16), transparent 24%), linear-gradient(135deg, #020202 0%, #111111 50%, #220909 100%);
            color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            position: sticky;
            top: 0;
            z-index: 20;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            background: rgba(5,5,5,0.95);
            border-bottom: 1px solid rgba(255,75,75,0.16);
            backdrop-filter: blur(10px);
            gap: 12px;
        }
        .brand { font-size: 18px; font-weight: 800; color: #fff; text-decoration: none; white-space: nowrap; }
        .brand span { color: #ff5b5b; }
        .nav-links {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .nav-links a {
            color: #f0f0f0;
            text-decoration: none;
            padding: 8px 10px;
            border-radius: 999px;
            font-size: 13px;
            line-height: 1;
        }
        .nav-links a:hover { background: rgba(255,75,75,0.14); color: #ff9b9b; }
        .nav-links a.active {
            background: rgba(255,75,75,0.18);
            color: #ffffff;
            font-weight: 700;
            box-shadow: inset 0 0 0 1px rgba(255,75,75,0.24);
        }
        .page { max-width: 1200px; margin: 0 auto; padding: 20px 16px 40px; flex: 1; width: 100%; }
        .hero-box {
            background: rgba(8,8,8,0.82);
            border: 1px solid rgba(255,75,75,0.16);
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 16px;
        }
        .hero-box h1 { font-size: clamp(24px, 5vw, 36px); margin: 0 0 10px; }
        .hero-box p { color: #cfcfcf; line-height: 1.7; font-size: 15px; }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 18px;
            padding: 16px;
        }
        .card h3 { margin-top: 0; color: #ff8f8f; font-size: 16px; }
        .card ul { margin: 0; padding-left: 18px; color: #ddd; line-height: 1.8; font-size: 14px; }
        .mobile-menu-toggle {
            display: none;
            background: transparent;
            border: 1px solid rgba(255,75,75,0.25);
            color: #fff;
            padding: 8px 10px;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .footer {
            width: 100%;
            padding: 16px 16px;
            text-align: center;
            color: #f5f5f5;
            font-size: 14px;
            background: rgba(5,5,5,0.95);
            border-top: 1px solid rgba(255,75,75,0.16);
            backdrop-filter: blur(10px);
            margin-top: auto;
        }
        @media (max-width: 760px) {
            .navbar {
                flex-wrap: wrap;
                align-items: center;
            }
            .mobile-menu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                padding-top: 8px;
                gap: 6px;
            }
            .nav-links.open {
                display: flex;
            }
            .nav-links a {
                padding: 10px 12px;
                background: rgba(255,255,255,0.03);
                border: 1px solid rgba(255,255,255,0.05);
                border-radius: 10px;
            }
            .page { padding: 16px 12px 32px; }
            .grid { grid-template-columns: 1fr; }
            .hero-box { padding: 20px; }
        }
    </style>
</head>
<body>
    @php
        $currentPath = request()->path();
    @endphp
    <nav class="navbar">
        <a href="/" class="brand">UAB <span>Portal</span></a>
        <button class="mobile-menu-toggle" type="button" onclick="document.querySelector('.nav-links').classList.toggle('open')">☰</button>
        <div class="nav-links">
            <a href="/" class="{{ $currentPath === '/' ? 'active' : '' }}">Beranda</a>
            <a href="/visi-misi" class="{{ $currentPath === 'visi-misi' ? 'active' : '' }}">Visi Misi</a>
            <a href="/pengurus/ketum" class="{{ request()->is('pengurus*') ? 'active' : '' }}">Pengurus</a>
            <a href="/lokasi" class="{{ $currentPath === 'lokasi' ? 'active' : '' }}">Lokasi</a>
            <a href="/penyewaan" class="{{ $currentPath === '/penyewaan' ? 'active' : '' }}">Penyewaan</a>
            <a href="/booklet-band" class="{{ $currentPath === '/booklet-band' ? 'active' : '' }}">Booklet Band</a>
            <a href="/undangan-media-partner" class="{{ $currentPath === '/undangan-media-partner' ? 'active' : '' }}">Undangan & Media Partner</a>
            <a href="/rilisan" class="{{ $currentPath === '/rilisan' ? 'active' : '' }}">Rilisan</a>
            <a href="/informasi" class="{{ $currentPath === '/informasi' ? 'active' : '' }}">Informasi</a>
        </div>
    </nav>

    <main class="page">
        @yield('content')
    </main>

    <footer class="footer">
        © 2026 Unit Aktivitas Band Universitas Brawijaya.
    </footer>
</body>
</html>
