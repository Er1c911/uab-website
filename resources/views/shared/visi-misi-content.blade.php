<div style="max-width:860px;margin:0 auto;padding:40px 16px;">
    <h1 style="text-align:center;margin-bottom:70px;">{{ $content['title'] ?? 'Visi & Misi' }}</h1>

    @if(!empty($content['visi']))
        <section style="margin-top:32px; text-align:center;">
            <h2>Visi</h2>
            <p style="text-align:center;">{{ $content['visi'] }}</p>
        </section>
    @endif

    @if(!empty($content['misi']))
        <section style="margin-top:32px; text-align:center;">
            <h2>Misi</h2>
            <ul style="display:inline-block;text-align:left;list-style: disc inside;line-height:1.8;">
                @foreach($content['misi'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>
    @endif
</div>
