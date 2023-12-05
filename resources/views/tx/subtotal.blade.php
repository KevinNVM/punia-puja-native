<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <h1 class="text-2xl font-semibold">Daftar Subtotal</h1>
                <a href="{{ route('dashboard') }}" class="btn max-w-xs">Kembali ke dashboard</a>

                <div class="divider"></div>

                @livewire('tx-subtotal-list')

            </div>
        </div>
    </div>
</x-app-layout>
