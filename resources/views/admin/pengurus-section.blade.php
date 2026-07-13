<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola {{ ucfirst(str_replace('-', ' ', $section)) }}</title>
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
        .top-actions { display:flex; gap:10px; flex-wrap:wrap; align-items:center; }
        .ghost-btn, .logout, .primary-btn {
            text-decoration: none;
            border-radius: 999px;
            padding: 10px 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
        }
        .ghost-btn {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .logout { color: #ff8d8d; background: rgba(255,77,77,0.12); }
        .primary-btn {
            color: #fff;
            background: linear-gradient(135deg, #ff4d4d, #d22323);
            box-shadow: 0 18px 40px rgba(255,77,77,0.2);
        }
        .card {
            background: #0f0f0f;
            border: 1px solid rgba(255,69,69,0.18);
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h2 { margin: 0 0 8px; font-size: 18px; color: #ff8f8f; }
        .card p { margin: 0 0 16px; color: #9a9a9a; line-height: 1.6; }
        .entry-card {
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 12px;
            background: rgba(255,255,255,0.03);
        }
        .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field-group { display: grid; gap: 8px; margin-bottom: 12px; }
        .field-group label { font-size: 13px; color: #ccc; }
        .field-group input { width: 100%; padding: 10px 12px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.08); background: #111; color: #f5f5f5; }
        .field-group input::placeholder { color: #7f7f7f; }
        .submit-row { display: flex; justify-content: flex-end; margin-top: 24px; }
        .submit-row button { padding: 12px 20px; border: none; border-radius: 999px; background: linear-gradient(135deg, #ff4d4d, #d22323); color: #fff; font-weight: 700; cursor: pointer; }
        .submit-row button:hover { opacity: 0.95; }
        .hint { font-size: 13px; color: #8d8d8d; margin-top: 8px; }
        @media (max-width: 760px) {
            .field-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div class="brand">UAB <span>Admin</span></div>
            <div class="top-actions">
                <a class="ghost-btn" href="/admin/pengurus">Kembali</a>
                <form method="POST" action="/admin/logout" style="margin:0;">
                    @csrf
                    <button class="logout" type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="card">
            <h2>Kelola {{ ucfirst(str_replace('-', ' ', $section)) }}</h2>
            <p>Tambahkan, edit, atau hapus data pengurus untuk halaman pengguna ini. Tidak ada batas jumlah data.</p>
            <form method="POST" action="/admin/pengurus/{{ $section }}">
                @csrf
                @php
                    $entries = is_array($entries) ? $entries : [];
                    if ($entries === []) {
                        $entries = [['name' => '', 'position' => '', 'photo_url' => '']];
                    }
                @endphp

                <div id="entry-list">
                    @foreach($entries as $index => $entry)
                        <div class="entry-card">
                            <div class="field-grid">
                                <div class="field-group">
                                    <label for="entries-{{ $index }}-name">Nama</label>
                                    <input id="entries-{{ $index }}-name" name="entries[{{ $index }}][name]" type="text" value="{{ $entry['name'] ?? '' }}" placeholder="Masukkan nama">
                                </div>
                                <div class="field-group">
                                    <label for="entries-{{ $index }}-position">Posisi</label>
                                    <input id="entries-{{ $index }}-position" name="entries[{{ $index }}][position]" type="text" value="{{ $entry['position'] ?? '' }}" placeholder="Masukkan posisi">
                                </div>
                            </div>
                            <div class="field-group">
                                <label for="entries-{{ $index }}-photo_url">URL Foto</label>
                                <input id="entries-{{ $index }}-photo_url" name="entries[{{ $index }}][photo_url]" type="text" value="{{ $entry['photo_url'] ?? '' }}" placeholder="https://example.com/foto.jpg">
                            </div>
                            <div style="display:flex;justify-content:flex-end;">
                                <button class="ghost-btn remove-entry" type="button">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap; margin-bottom:16px;">
                    <div class="hint">Anda dapat menambahkan data sebanyak yang diperlukan.</div>
                    <button class="ghost-btn" id="add-entry-btn" type="button">Tambah Data</button>
                </div>

                <div class="submit-row">
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entryList = document.getElementById('entry-list');
            const addEntryButton = document.getElementById('add-entry-btn');
            let entryIndex = {{ count($entries) }};

            if (addEntryButton && entryList) {
                addEntryButton.addEventListener('click', function () {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'entry-card';
                    wrapper.innerHTML = `
                        <div class="field-grid">
                            <div class="field-group">
                                <label for="entries-${entryIndex}-name">Nama</label>
                                <input id="entries-${entryIndex}-name" name="entries[${entryIndex}][name]" type="text" placeholder="Masukkan nama">
                            </div>
                            <div class="field-group">
                                <label for="entries-${entryIndex}-position">Posisi</label>
                                <input id="entries-${entryIndex}-position" name="entries[${entryIndex}][position]" type="text" placeholder="Masukkan posisi">
                            </div>
                        </div>
                        <div class="field-group">
                            <label for="entries-${entryIndex}-photo_url">URL Foto</label>
                            <input id="entries-${entryIndex}-photo_url" name="entries[${entryIndex}][photo_url]" type="text" placeholder="https://example.com/foto.jpg">
                        </div>
                        <div style="display:flex;justify-content:flex-end;">
                            <button class="ghost-btn remove-entry" type="button">Hapus</button>
                        </div>
                    `;
                    entryList.appendChild(wrapper);
                    entryIndex += 1;
                });
            }

            entryList?.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-entry')) {
                    event.target.closest('.entry-card')?.remove();
                }
            });
        });
    </script>
</body>
</html>
