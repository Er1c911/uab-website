<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        :root { color-scheme: dark; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: linear-gradient(135deg, #050505 0%, #121212 45%, #240909 100%);
            color: #f4f4f4;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .card {
            width: min(100%, 430px);
            background: rgba(7,7,7,0.95);
            border: 1px solid rgba(255,61,61,0.25);
            border-radius: 20px;
            padding: 34px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.45);
        }
        h1 { margin: 0 0 8px; font-size: 28px; }
        p { color: #bdbdbd; margin-top: 0; }
        .field { margin-bottom: 14px; }
        label { display: block; margin-bottom: 8px; font-size: 14px; color: #e8e8e8; }
        input { width: 100%; box-sizing: border-box; padding: 12px 14px; border-radius: 10px; border: 1px solid #333; background: #111; color: white; }
        button { width: 100%; margin-top: 10px; padding: 12px 16px; border: none; border-radius: 10px; background: linear-gradient(90deg, #ff2f2f, #9e0000); color: white; font-weight: 700; cursor: pointer; }
        .error { color: #ff7b7b; margin-top: 12px; font-size: 14px; }
        .hint { margin-top: 16px; font-size: 13px; color: #8d8d8d; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Admin Login</h1>
        <p>Masuk ke dashboard administrator.</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first('credentials') }}</div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf
            <div class="field">
                <label for="username">Username</label>
                <input id="username" name="username" required autocomplete="username" value="uabadmins">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" value="Homeband1Kekuatan">
            </div>
            <button type="submit">Login</button>
        </form>

        <div class="hint">Kredensial yang dipakai adalah username <strong>uabadmins</strong> dan password <strong>Homeband1Kekuatan</strong>.</div>
    </div>
</body>
</html>
