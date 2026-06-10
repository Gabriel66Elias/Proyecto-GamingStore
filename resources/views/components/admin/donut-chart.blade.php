@props(['eyebrow', 'title', 'segments', 'centerValue', 'centerLabel'])

@php
    $total = collect($segments)->sum('value');
    $cumulative = 0;
@endphp

<div class="admin-card donut-card">
    <p class="dash-section-eyebrow">{{ $eyebrow }}</p>
    <h6 class="dash-section-title mb-3">{{ $title }}</h6>

    <div class="donut-wrap">
        <div class="donut-chart-container">
            <svg viewBox="0 0 36 36" class="donut-svg">
                <circle class="donut-ring" cx="18" cy="18" r="15.915" fill="transparent" stroke="#1f222e" stroke-width="3.5"></circle>
                @if($total > 0)
                <g class="donut-rotate">
                    @foreach($segments as $seg)
                        @if($seg['value'] > 0)
                            @php
                                $pct = ($seg['value'] / $total) * 100;
                                $dashoffset = -$cumulative;
                                $cumulative += $pct;
                            @endphp
                            <circle cx="18" cy="18" r="15.915" fill="transparent"
                                    stroke="{{ $seg['color'] }}" stroke-width="3.5"
                                    stroke-dasharray="{{ round($pct, 3) }} {{ round(100 - $pct, 3) }}"
                                    stroke-dashoffset="{{ round($dashoffset, 3) }}"
                                    stroke-linecap="round"></circle>
                        @endif
                    @endforeach
                </g>
                @endif
            </svg>
            <div class="donut-center">
                <span class="donut-center-value">{{ $centerValue }}</span>
                <span class="donut-center-label">{{ $centerLabel }}</span>
            </div>
        </div>

        <ul class="donut-legend">
            @foreach($segments as $seg)
            <li>
                <span class="donut-legend-dot" style="background-color: {{ $seg['color'] }};"></span>
                <span class="donut-legend-label">{{ $seg['label'] }}</span>
                <span class="donut-legend-value">{{ $seg['display'] ?? $seg['value'] }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    {{ $slot }}
</div>
