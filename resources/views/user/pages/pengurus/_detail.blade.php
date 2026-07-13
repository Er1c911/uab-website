@php
    $entries = is_array($pengurus) ? $pengurus : [];
    if ($entries !== [] && (array_key_exists('name', $entries) || array_key_exists('position', $entries) || array_key_exists('photo_url', $entries))) {
        $entries = [$entries];
    }

    $entries = array_values(array_filter($entries, function ($entry) {
        return is_array($entry);
    }));

    // Check if this is one of the divisions that needs special layout
    $divisionsWithLevels = ['manajemen-event', 'manajemen-talent', 'produksi', 'rt', 'psdm'];
    $isLeveledDivision = in_array($section ?? null, $divisionsWithLevels);

    // Separate entries by position if this is a leveled division
    $leaders = [];
    $staff = [];
    if ($isLeveledDivision) {
        foreach ($entries as $entry) {
            $position = strtolower(trim($entry['position'] ?? ''));
            if (strpos($position, 'ketua') !== false || strpos($position, 'wakil') !== false) {
                $leaders[] = $entry;
            } else {
                $staff[] = $entry;
            }
        }
    }
@endphp

@if ($isLeveledDivision)
    {{-- Leveled layout: Leaders first, then staff --}}
    <div style="max-width:1000px;margin:0 auto;padding:20px 16px;">
        {{-- Leaders section --}}
        @if (count($leaders) > 0)
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px; margin-bottom:32px;">
                @foreach ($leaders as $entry)
                    @php
                        $photoUrl = trim($entry['photo_url'] ?? '');
                    @endphp
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius:20px; overflow:hidden; transition:transform 0.2s ease, box-shadow 0.2s ease; cursor:pointer; display:flex; flex-direction:column; height:100%;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(255,75,75,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        @if($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Foto {{ $entry['name'] ?? 'Pengurus' }}" style="width:100%; aspect-ratio:4/5; object-fit:cover; display:block; flex-shrink:0;" />
                        @else
                            <div style="width:100%; aspect-ratio:4/5; background: rgba(255,75,75,0.1); display:flex; align-items:center; justify-content:center; color:#8d8d8d; flex-shrink:0;">Tidak ada foto</div>
                        @endif
                        <div style="padding:20px; text-align:center; flex:1; display:flex; flex-direction:column; justify-content:center;">
                            <h3 style="margin:0 0 12px; font-size:18px; line-height:1.3; color:#ff8f8f; font-weight:700;">{{ $entry['position'] ?? '-' }}</h3>
                            <p style="margin:0; font-size:14px; color:#ddd; line-height:1.6;">{{ $entry['name'] ?? '-' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Staff section --}}
        @if (count($staff) > 0)
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px;">
                @foreach ($staff as $entry)
                    @php
                        $photoUrl = trim($entry['photo_url'] ?? '');
                    @endphp
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius:20px; overflow:hidden; transition:transform 0.2s ease, box-shadow 0.2s ease; cursor:pointer; display:flex; flex-direction:column; height:100%;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(255,75,75,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        @if($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Foto {{ $entry['name'] ?? 'Pengurus' }}" style="width:100%; aspect-ratio:4/5; object-fit:cover; display:block; flex-shrink:0;" />
                        @else
                            <div style="width:100%; aspect-ratio:4/5; background: rgba(255,75,75,0.1); display:flex; align-items:center; justify-content:center; color:#8d8d8d; flex-shrink:0;">Tidak ada foto</div>
                        @endif
                        <div style="padding:20px; text-align:center; flex:1; display:flex; flex-direction:column; justify-content:center;">
                            <h3 style="margin:0 0 12px; font-size:18px; line-height:1.3; color:#ff8f8f; font-weight:700;">{{ $entry['position'] ?? '-' }}</h3>
                            <p style="margin:0; font-size:14px; color:#ddd; line-height:1.6;">{{ $entry['name'] ?? '-' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Empty state --}}
        @if (count($leaders) === 0 && count($staff) === 0)
            <div style="text-align:center; color:#8d8d8d; padding:40px 20px;">Belum ada data pengurus.</div>
        @endif
    </div>
@else
    {{-- Standard layout for other sections --}}
    <div style="max-width:1000px;margin:0 auto;padding:20px 16px; display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px;">
        @forelse($entries as $entry)
            @php
                $photoUrl = trim($entry['photo_url'] ?? '');
            @endphp
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius:20px; overflow:hidden; transition:transform 0.2s ease, box-shadow 0.2s ease; cursor:pointer; display:flex; flex-direction:column; height:100%;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(255,75,75,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                @if($photoUrl)
                    <img src="{{ $photoUrl }}" alt="Foto {{ $entry['name'] ?? 'Pengurus' }}" style="width:100%; aspect-ratio:4/5; object-fit:cover; display:block; flex-shrink:0;" />
                @else
                    <div style="width:100%; aspect-ratio:4/5; background: rgba(255,75,75,0.1); display:flex; align-items:center; justify-content:center; color:#8d8d8d; flex-shrink:0;">Tidak ada foto</div>
                @endif
                <div style="padding:20px; text-align:center; flex:1; display:flex; flex-direction:column; justify-content:center;">
                    <h3 style="margin:0 0 12px; font-size:18px; line-height:1.3; color:#ff8f8f; font-weight:700;">{{ $entry['position'] ?? '-' }}</h3>
                    <p style="margin:0; font-size:14px; color:#ddd; line-height:1.6;">{{ $entry['name'] ?? '-' }}</p>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1; text-align:center; color:#8d8d8d; padding:40px 20px;">Belum ada data pengurus.</div>
        @endforelse
    </div>
@endif
