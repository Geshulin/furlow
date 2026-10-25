<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-hover inline-flex items-center justify-center rounded-full bg-furlow-accent px-6 py-3 text-sm font-semibold text-furlow-accent-ink focus:outline-none focus:ring-2 focus:ring-furlow-accent focus:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>