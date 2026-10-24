<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center rounded-full border border-furlow-ink/20 bg-white px-6 py-3 text-sm font-semibold text-furlow-ink transition hover:border-furlow-ink disabled:opacity-50']) }}>
    {{ $slot }}
</button>