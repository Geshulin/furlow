<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl font-semibold text-furlow-ink">Profil</h1>
    </x-slot>

    <div class="max-w-xl space-y-6">
        <div class="rounded-2xl bg-white p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="rounded-2xl bg-white p-6">
            @include('profile.partials.update-password-form')
        </div>

        {{-- Hapus akun disembunyikan (melanggar foreign key jika pemilik punya hewan)
        <div class="rounded-2xl bg-white p-6">
            @include('profile.partials.delete-user-form')
        </div>
        --}}
    </div>
</x-app-layout>