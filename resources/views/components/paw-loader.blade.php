<div class="paw-loader" role="status" aria-label="Memuat">
    @for ($i = 0; $i < 10; $i++)
        <svg style="--i: {{ $i }}; --t: {{ $i % 2 ? '-14deg' : '14deg' }}" viewBox="0 0 24 24" fill="#1F3A2E">
            <circle cx="12" cy="16" r="4.2"/>
            <circle cx="5" cy="9" r="1.8"/>
            <circle cx="19" cy="9" r="1.8"/>
            <circle cx="8.4" cy="5.6" r="1.6"/>
            <circle cx="15.6" cy="5.6" r="1.6"/>
        </svg>
    @endfor
</div>