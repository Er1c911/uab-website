<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengurus</title>
    <style>
        :root { color-scheme: dark; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #050505;
            color: #f5f5f5;
        }
        .shell { min-height: 100vh; padding: 24px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 12px; flex-wrap: wrap; }
        .brand { font-size: 24px; font-weight: 800; }
        .brand span { color: #ff4d4d; }
        .logout { text-decoration: none; color: #ff8d8d; background: rgba(255,77,77,0.12); padding: 10px 14px; border-radius: 999px; }
        .manage-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            color: #fff;
            background: linear-gradient(135deg, #ff4d4d, #d22323);
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 18px 40px rgba(255,77,77,0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }
        .manage-btn:hover { transform: translateY(-1px); box-shadow: 0 22px 48px rgba(255,77,77,0.28); background: linear-gradient(135deg, #ff6a6a, #e02d2d); }
        .section-card { background: #0f0f0f; border: 1px solid rgba(255,69,69,0.18); border-radius: 18px; padding: 20px; margin-bottom: 20px; }
        .section-card h2 { margin: 0 0 16px; font-size: 18px; color: #ff8f8f; }
        .note { color: #8d8d8d; margin: 0 0 24px; }
        .button-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div class="brand">UAB <span>Admin</span></div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a class="manage-btn btn-secondary" href="/admin/dashboard">Kembali</a>
                <form method="POST" action="/admin/logout" style="margin:0;">
                    @csrf
                    <button class="logout" type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="section-card">
            <h2>Kelola Halaman Pengurus</h2>
            <p class="note">Pilih halaman pengurus di user yang ingin Anda kelola. Setiap halaman mendukung CRUD data tanpa batas.</p>
            <div class="button-grid">
                <a class="manage-btn" href="/admin/pengurus/ketum">Ketum</a>
                <a class="manage-btn" href="/admin/pengurus/waketum">Waketum</a>
                <a class="manage-btn" href="/admin/pengurus/sekben">Sekben</a>
                <a class="manage-btn" href="/admin/pengurus/litbang">Litbang</a>
                <a class="manage-btn" href="/admin/pengurus/manajemen-event">Manajemen Event</a>
                <a class="manage-btn" href="/admin/pengurus/manajemen-talent">Manajemen Talent</a>
                <a class="manage-btn" href="/admin/pengurus/produksi">Produksi</a>
                <a class="manage-btn" href="/admin/pengurus/rt">RT</a>
                <a class="manage-btn" href="/admin/pengurus/psdm">PSDM</a>
            </div>
        </div>
    </div>
</body>
</html>
