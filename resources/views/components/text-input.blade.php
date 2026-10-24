@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border-furlow-ink/20 bg-white text-furlow-ink shadow-sm focus:border-furlow-teal focus:ring-furlow-teal']) }}>