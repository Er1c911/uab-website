<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$visiMisiFile = storage_path('app/visi-misi.json');

$loadVisiMisiContent = function () use ($visiMisiFile) {
    if (! file_exists($visiMisiFile)) {
        return [
            'title' => 'Visi & Misi UAB UB',
            'visi' => 'Revitalisasi Unit Aktivitas Band Universitas Brawijaya sebagai organisasi musik kampus yang aktif, tertata, dan berdaya guna, serta diakui keberadaannya oleh sivitas akademika UB dan ekosistem musik Malang',
            'misi' => [],
        ];
    }

    $data = json_decode(file_get_contents($visiMisiFile), true);

    return is_array($data) ? array_merge([
        'title' => 'Visi & Misi UAB UB',
        'visi' => '',
        'misi' => [],
    ], $data) : [
        'title' => 'Visi & Misi UAB UB',
        'visi' => '',
        'misi' => [],
    ];
};

$saveVisiMisiContent = function (array $data) use ($visiMisiFile) {
    if (! is_dir(dirname($visiMisiFile))) {
        mkdir(dirname($visiMisiFile), 0755, true);
    }

    file_put_contents($visiMisiFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
};

$pengurusFile = storage_path('app/pengurus.json');

$normalizePengurusEntries = function ($value) {
    if (! is_array($value)) {
        return [];
    }

    if (array_key_exists('name', $value) || array_key_exists('position', $value) || array_key_exists('photo_url', $value)) {
        return [[
            'name' => trim((string) ($value['name'] ?? '')),
            'position' => trim((string) ($value['position'] ?? '')),
            'photo_url' => trim((string) ($value['photo_url'] ?? '')),
        ]];
    }

    $entries = [];
    foreach ($value as $item) {
        if (! is_array($item)) {
            continue;
        }

        $entry = [
            'name' => trim((string) ($item['name'] ?? '')),
            'position' => trim((string) ($item['position'] ?? '')),
            'photo_url' => trim((string) ($item['photo_url'] ?? '')),
        ];

        if ($entry['name'] !== '' || $entry['position'] !== '' || $entry['photo_url'] !== '') {
            $entries[] = $entry;
        }
    }

    return array_values($entries);
};

$loadPengurusContent = function () use ($pengurusFile, $normalizePengurusEntries) {
    $defaults = [
        'ketum' => [],
        'waketum' => [],
        'sekben' => [],
        'litbang' => [],
        'manajemen-event' => [],
        'manajemen-talent' => [],
        'produksi' => [],
        'rt' => [],
        'psdm' => [],
    ];

    if (! file_exists($pengurusFile)) {
        return $defaults;
    }

    $data = json_decode(file_get_contents($pengurusFile), true);

    if (! is_array($data)) {
        return $defaults;
    }

    $result = [];
    foreach ($defaults as $section => $_default) {
        $result[$section] = $normalizePengurusEntries($data[$section] ?? []);
    }

    return $result;
};

$savePengurusContent = function (array $data) use ($pengurusFile) {
    if (! is_dir(dirname($pengurusFile))) {
        mkdir(dirname($pengurusFile), 0755, true);
    }

    file_put_contents($pengurusFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
};

$renderPengurusPage = function (string $view, string $section) use ($loadPengurusContent) {
    return function () use ($view, $section, $loadPengurusContent) {
        $pengurusData = $loadPengurusContent();

        return view($view, [
            'pengurus' => $pengurusData[$section] ?? [],
            'section' => $section,
        ]);
    };
};

Route::get('/', function () {
    return view('user.pages.beranda');
});

Route::get('/lokasi', function () {
    return view('user.pages.lokasi');
});

Route::get('/pengurus', function () {
    return redirect('/pengurus/ketum');
});

Route::get('/pengurus/ketum', $renderPengurusPage('user.pages.pengurus.ketum', 'ketum'));

Route::get('/pengurus/waketum', $renderPengurusPage('user.pages.pengurus.waketum', 'waketum'));

Route::get('/pengurus/sekben', $renderPengurusPage('user.pages.pengurus.sekben', 'sekben'));

Route::get('/pengurus/litbang', $renderPengurusPage('user.pages.pengurus.litbang', 'litbang'));

Route::get('/pengurus/manajemen-event', $renderPengurusPage('user.pages.pengurus.manajemen-event', 'manajemen-event'));

Route::get('/pengurus/manajemen-talent', $renderPengurusPage('user.pages.pengurus.manajemen-talent', 'manajemen-talent'));

Route::get('/pengurus/produksi', $renderPengurusPage('user.pages.pengurus.produksi', 'produksi'));

Route::get('/pengurus/rt', $renderPengurusPage('user.pages.pengurus.rt', 'rt'));

Route::get('/pengurus/psdm', $renderPengurusPage('user.pages.pengurus.psdm', 'psdm'));

Route::get('/penyewaan', function () {
    return view('user.pages.penyewaan');
});

Route::get('/booklet-band', function () {
    return view('user.pages.booklet-band');
});

Route::get('/undangan-media-partner', function () {
    return view('user.pages.undangan-media-partner');
});

Route::get('/rilisan', function () {
    return view('user.pages.rilisan');
});

Route::get('/informasi', function () {
    return view('user.pages.informasi');
});

Route::get('/visi-misi', function () use ($loadVisiMisiContent) {
    return view('user.pages.visi-misi', ['content' => $loadVisiMisiContent()]);
});

Route::get('/admin/visi-misi', function (Request $request) use ($loadVisiMisiContent) {
    if (! $request->session()->get('is_admin')) {
        return redirect('/admin/login');
    }

    return view('admin.visi-misi', ['content' => $loadVisiMisiContent()]);
});

Route::post('/admin/visi-misi', function (Request $request) use ($saveVisiMisiContent) {
    if (! $request->session()->get('is_admin')) {
        return redirect('/admin/login');
    }

    $misi = array_values(array_filter(array_map('trim', explode("\n", $request->input('misi', '')))));
    $content = [
        'title' => trim($request->input('title', 'Visi & Misi UAB UB')),
        'visi' => trim($request->input('visi', '')),
        'misi' => $misi,
    ];

    $saveVisiMisiContent($content);

    return redirect('/admin/visi-misi');
});

Route::get('/admin/pengurus', function (Request $request) use ($loadPengurusContent) {
    if (! $request->session()->get('is_admin')) {
        return redirect('/admin/login');
    }

    return view('admin.pengurus', ['pengurus' => $loadPengurusContent()]);
});

Route::get('/admin/pengurus/{section}', function (Request $request, string $section) use ($loadPengurusContent, $savePengurusContent) {
    if (! $request->session()->get('is_admin')) {
        return redirect('/admin/login');
    }

    $sections = [
        'ketum',
        'waketum',
        'sekben',
        'litbang',
        'manajemen-event',
        'manajemen-talent',
        'produksi',
        'rt',
        'psdm',
    ];

    if (! in_array($section, $sections, true)) {
        abort(404);
    }

    $data = $loadPengurusContent();

    return view('admin.pengurus-section', [
        'section' => $section,
        'entries' => $data[$section] ?? [],
    ]);
})->where('section', '[a-zA-Z0-9\-]+');

Route::post('/admin/pengurus/{section}', function (Request $request, string $section) use ($loadPengurusContent, $savePengurusContent) {
    if (! $request->session()->get('is_admin')) {
        return redirect('/admin/login');
    }

    $sections = [
        'ketum',
        'waketum',
        'sekben',
        'litbang',
        'manajemen-event',
        'manajemen-talent',
        'produksi',
        'rt',
        'psdm',
    ];

    if (! in_array($section, $sections, true)) {
        abort(404);
    }

    $data = $loadPengurusContent();
    $entries = $request->input('entries', []);
    $normalizedEntries = [];

    foreach ($entries as $entry) {
        if (! is_array($entry)) {
            continue;
        }

        $normalizedEntry = [
            'name' => trim((string) ($entry['name'] ?? '')),
            'position' => trim((string) ($entry['position'] ?? '')),
            'photo_url' => trim((string) ($entry['photo_url'] ?? '')),
        ];

        if ($normalizedEntry['name'] !== '' || $normalizedEntry['position'] !== '' || $normalizedEntry['photo_url'] !== '') {
            $normalizedEntries[] = $normalizedEntry;
        }
    }

    $data[$section] = array_values($normalizedEntries);
    $savePengurusContent($data);

    return redirect('/admin/pengurus/' . $section);
});

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    if ($request->input('username') === 'uabadmins' && $request->input('password') === 'Homeband1Kekuatan') {
        $request->session()->put('is_admin', true);

        return redirect('/admin/dashboard');
    }

    return back()->withErrors([
        'credentials' => 'Username atau password salah.',
    ]);
});

Route::get('/admin/dashboard', function (Request $request) {
    if (! $request->session()->get('is_admin')) {
        return redirect('/admin/login');
    }

    return view('admin.dashboard');
})->name('admin.dashboard');

Route::post('/admin/logout', function (Request $request) {
    $request->session()->forget('is_admin');

    return redirect('/admin/login');
})->name('admin.logout');
