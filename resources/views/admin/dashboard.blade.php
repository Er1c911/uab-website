<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        :root { color-scheme: dark; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #050505;
            color: #f4f4f4;
        }
        .shell { min-height: 100vh; padding: 24px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
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
        .manage-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 22px 48px rgba(255,77,77,0.28);
            background: linear-gradient(135deg, #ff6a6a, #e02d2d);
        }
        .grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 18px; }
        .panel { background: #0f0f0f; border: 1px solid rgba(255,69,69,0.18); border-radius: 18px; padding: 20px; box-shadow: 0 12px 32px rgba(0,0,0,0.35); }
        .kpi { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 12px; margin-top: 16px; }
        .kpi > div { background: #171717; border: 1px solid #2b2b2b; border-radius: 14px; padding: 14px; }
        .kpi strong { display: block; font-size: 22px; color: #ff5b5b; }
        .list { margin: 0; padding-left: 18px; color: #d0d0d0; }
        .muted { color: #8d8d8d; }
        @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } .kpi { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div class="brand">UAB <span>Admin</span></div>
            <form method="POST" action="/admin/logout">
                @csrf
                <button class="logout" type="submit">Logout</button>
            </form>
        </div>

        <div style="margin-top:20px;">
            <a href="/admin/visi-misi" class="manage-btn">Kelola Visi Misi</a>
            <a href="/admin/pengurus" class="manage-btn" style="margin-left: 12px;">Kelola Pengurus</a>
        </div>
    </div>
</body>
</html>
