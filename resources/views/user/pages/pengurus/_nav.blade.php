@php
    $pengurusLinks = [
        ['label' => 'Ketum', 'href' => '/pengurus/ketum'],
        ['label' => 'Waketum', 'href' => '/pengurus/waketum'],
        ['label' => 'Sekben', 'href' => '/pengurus/sekben'],
        ['label' => 'Litbang', 'href' => '/pengurus/litbang'],
        ['label' => 'Manajemen Event', 'href' => '/pengurus/manajemen-event'],
        ['label' => 'Manajemen Talent', 'href' => '/pengurus/manajemen-talent'],
        ['label' => 'Produksi', 'href' => '/pengurus/produksi'],
        ['label' => 'RT', 'href' => '/pengurus/rt'],
        ['label' => 'PSDM', 'href' => '/pengurus/psdm'],
    ];
@endphp

<style>
    main.page { padding-top: 0 !important; }
    .pengurus-subnav {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        background: rgba(5,5,5,0.95);
        border-bottom: 1px solid rgba(255,75,75,0.16);
        padding: 12px 16px;
        align-items: center;
        border-radius: 0 0 24px 24px;
    }
    .pengurus-subnav a {
        color: #f0f0f0;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 13px;
        line-height: 1;
        transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    }
    .pengurus-subnav a:hover {
        background: rgba(255,75,75,0.14);
        color: #ff9b9b;
    }
    .pengurus-subnav a.active {
        background: rgba(255,75,75,0.18);
        color: #ffffff;
        font-weight: 700;
        box-shadow: inset 0 0 0 1px rgba(255,75,75,0.24);
    }
</style>

<div style="max-width:1000px;margin:0 auto;padding:0 16px 20px;">
    <nav class="pengurus-subnav">
        @foreach($pengurusLinks as $item)
            <a href="{{ $item['href'] }}" class="{{ request()->is(ltrim(parse_url($item['href'], PHP_URL_PATH), '/')) ? 'active' : '' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</div>
