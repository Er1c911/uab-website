<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Digital UAB</title>
    <style>
        :root { color-scheme: dark; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: radial-gradient(circle at top left, rgba(255,69,69,0.18), transparent 30%), linear-gradient(135deg, #020202 0%, #111111 55%, #220909 100%);
            color: #f5f5f5;
            min-height: 100vh;
        }
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .content {
            width: 100%;
            max-width: 1400px;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
            align-items: stretch;
        }
        .left {
            padding: 48px;
            border-radius: 32px;
            background: rgba(8, 8, 8, 0.82);
            border: 1px solid rgba(255,75,75,0.16);
            backdrop-filter: blur(16px);
        }
        .eyebrow { display: inline-block; background: rgba(255, 45, 45, 0.14); color: #ff6b6b; padding: 8px 12px; border-radius: 999px; font-size: 12px; letter-spacing: 0.22em; text-transform: uppercase; }
        h1 { font-size: clamp(36px, 5vw, 64px); margin: 16px 0 14px; line-height: 1.05; }
        p { color: #cfcfcf; line-height: 1.8; max-width: 640px; font-size: 18px; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 28px; }
        .btn { text-decoration: none; padding: 13px 20px; border-radius: 999px; font-weight: 700; }
        .btn-primary { background: linear-gradient(90deg, #ff2e2e, #b10000); color: white; }
        .btn-secondary { background: transparent; color: #ececec; border: 1px solid #3e3e3e; }
        .right {
            display: grid;
            gap: 16px;
        }
        .panel {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 24px;
            padding: 24px;
        }
        .panel h3 { margin: 0 0 10px; font-size: 18px; }
        .panel ul { margin: 0; padding-left: 18px; color: #d6d6d6; line-height: 1.7; }
        .accent { color: #ff6b6b; font-weight: 700; }
        @media (max-width: 900px) {
            .content { grid-template-columns: 1fr; }
            .left { padding: 32px; }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="content">
            <div class="left">
                <span class="eyebrow">Digital Experience</span>
                <h1>Platform Digital <span class="accent">UAB</span></h1>
                <p>Selamat datang di portal pengguna yang sederhana, modern, dan siap untuk kebutuhan administrasi serta informasi internal.</p>
                <div class="actions">
                    <a href="/admin/login" class="btn btn-primary">Masuk Admin</a>
                    <a href="#" class="btn btn-secondary">Lihat Informasi</a>
                </div>
            </div>
            <div class="right">
                <div class="panel">
                    <h3>Kenapa memilih kami</h3>
                    <ul>
                        <li>Tampilan modern dan bersih</li>
                        <li>Warna dominan hitam dengan aksen merah</li>
                        <li>Fokus pada kenyamanan pengguna</li>
                    </ul>
                </div>
                <div class="panel">
                    <h3>Akses</h3>
                    <ul>
                        <li>Untuk user: tidak perlu login</li>
                        <li>Untuk admin: login khusus</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
