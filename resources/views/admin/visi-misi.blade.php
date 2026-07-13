<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Visi Misi</title>
    <style>
        :root { color-scheme: dark; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #050505;
            color: #f4f4f4;
        }
        .shell { min-height: 100vh; padding: 24px; }
        .topbar { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 20px; }
        .brand { font-size: 24px; font-weight: 800; }
        .brand span { color: #ff4d4d; }
        .manage-btn, .logout {
            text-decoration: none;
            color: #fff;
            background: #ff4d4d;
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 700;
        }
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
        .logout { background: rgba(255,77,77,0.12); color: #ff8d8d; }
        .form-panel {
            max-width: 860px;
            background: #0f0f0f;
            border: 1px solid rgba(255,69,69,0.18);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.35);
        }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"], textarea {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            background: #121212;
            color: #f4f4f4;
            padding: 14px;
            font-size: 15px;
        }
        textarea { min-height: 160px; resize: vertical; }
        .button-row { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; margin-top: 20px; }
        .btn-primary { background: #ff4d4d; color: #fff; border: none; cursor: pointer; }
        .btn-secondary { background: transparent; border: 1px solid rgba(255,255,255,0.15); color: #f4f4f4; }
        @media (max-width: 760px) { .topbar { flex-direction: column; align-items: stretch; } }
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

        <div class="form-panel">
            <h2>Kelola Visi Misi</h2>
            <p style="color:#b8b8b8;margin-top:8px;">Konten ini akan disinkronkan dengan halaman Visi Misi pengguna.</p>
            <form method="POST" action="/admin/visi-misi">
                @csrf
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input id="title" name="title" type="text" value="{{ $content['title'] ?? 'Visi & Misi UAB UB' }}">
                </div>
                <div class="form-group">
                    <label for="visi">Visi</label>
                    <textarea id="visi" name="visi">{{ $content['visi'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="misi">Misi (pisahkan setiap item baris baru)</label>
                    <textarea id="misi" name="misi">{{ isset($content['misi']) ? implode("\n", $content['misi']) : '' }}</textarea>
                </div>
                <div class="button-row">
                    <button class="btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
