<div class="flex flex-col gap-4" x-data="{
    getCurrentDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const day = String(today.getDate()).padStart(2, '0');

        const formattedDate = `${year}-${month}-${day}`;
        return formattedDate;
    }
}">
    <div>
        <div class="flex flex-col md:flex-row gap-2 md:items-center">
            <span>Menampilkan subtotal dari tanggal</span>
            <input type="date" wire:model.live="from">
            <span>sampai tanggal</span>
            <input type="date" wire:model.live="to">
        </div>
        <div class="divider">Atau</div>
        <div class="flex flex-col flex-start items-start">
            <button wire:click="toggleAccumulation" class="underline">
                {{ $showAccumulations ? 'Sembunyikan' : 'Tampilkan' }} Akumulasi</span>
            </button>
            <a href="?from=0&to=0" class="underline">
                Tampilkan subtotal <span class="text-blue-500">Hari ini</span>
            </a>
            <a href="?from=1&to=-1" class="underline">
                Tampilkan subtotal <span class="text-blue-500">Kemarin</span>
            </a>
            <a href="?from=7&to=0" class="underline">
                Tampilkan subtotal <span class="text-blue-500">Minggu ini</span>
            </a>
            <a href="?show_all=true" class="underline">
                Tampilkan semua subtotal</span>
            </a>
        </div>
    </div>



    <section class="border-t">

        <div class=" mt-4">
            <div class="flow-root">
                <dl class="-my-3 divide-y divide-gray-500 text-sm rounded-lg">
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-1 py-3 sm:gap-4 bg-gray-100 p-2">
                        <dt class="font-medium text-gray-900">Tanggal</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            Jumlah
                        </dd>
                        @if ($showAccumulations)
                            <dd class="text-gray-700 sm:col-span-2">
                                Akumulasi
                            </dd>
                        @endif
                    </div>
                    @forelse ($txes as $key => $tx)
                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-1 py-3 sm:gap-4 bg-lime-100 p-2">
                            <dt class="font-medium text-gray-900">{{ $tx->date->format('d M  Y') }}</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                {{ $tx->getFormattedAmount() }}
                            </dd>
                            @if ($showAccumulations)
                                <dd class="text-gray-700 sm:col-span-2">
                                    {{ 'Rp ' . number_format($accumulations[$key], 2, '.', ',') }}
                                </dd>
                            @endif
                        </div>
                    @empty
                        <p class="text-red-500">Tidak ada catatan di hari yang dipilih</p>
                    @endforelse
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-1 py-3 sm:gap-4 items-center">
                        <dt class="font-bold text-lg text-black">Subtotal</dt>
                        <dd class="text-gray-700 col-span-2 text-lg">
                            {{ 'Rp ' . number_format($txes->sum('amount'), 2, '.', ',') }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-1 py-3 sm:gap-4 items-center">
                        <dt class="font-bold text-black">Periode</dt>
                        <dd class="text-gray-700 col-span-2">
                            @if ($from === $to)
                                {{ date('d M Y', strtotime($from)) }}
                            @else
                                {{ date('d M Y', strtotime($from)) }}
                                s/d
                                {{ date('d M Y', strtotime($to)) }}
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

    </section>
</div>
