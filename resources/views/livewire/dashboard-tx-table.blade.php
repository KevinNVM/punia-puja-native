<div>
    <h3 class="text-lg p-2">Daftar catatan punia</h3>

    <div class="py-2 w-full justify-between md:flex">
        <div class="flex flex-col gap-2">
            {{-- <form>
                <label>Tampilkan data untuk :</label>
                <select name="select_date" @change="$el.closest('form').submit()">
                    <option value="0" {{ request('select_date') == '0' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="-1" {{ request('select_date') == '-1' ? 'selected' : '' }}>Kemarin</option>
                    <option value="-7" {{ request('select_date') == '-7' ? 'selected' : '' }}>Seminggu terakhir
                    </option>
                    <option value="-14" {{ request('select_date') == '-14' ? 'selected' : '' }}>2 Minggu terakhir
                    </option>
                    <option value="-30" {{ request('select_date') == '-30' ? 'selected' : '' }}>1 Bulan terakhir
                    </option>
                    <option {{ request('select_date', 'selected') }} value="">Tidak ada</option>
                </select>
            </form> --}}
            <div x-data="{ showAdvancedFilter: false }">
                <button class="btn btn-sm" @click="showAdvancedFilter = !showAdvancedFilter">Filter</button>
                <div class="p-2" x-show="showAdvancedFilter">
                    <div>
                        <label>Pilih hari</label>
                        <input type="date" wire:model.live="date">
                    </div>
                    <div class="divider">Atau</div>
                    <div>
                        <label>Pilih jangka waktu dari</label>
                        <input type="date" wire:model.live="from">
                        <label>sampai </label>
                        <input type="date" wire:model.live="to">
                    </div>
                    <div class="divider"></div>
                    <div>
                        <label>Cari nama</label>
                        <input type="text" wire:model.live="search">
                    </div>
                </div>
            </div>
        </div>
        <div class="p-2">
            <a href="{{ route('tx.create') }}" class="btn btn-primary">Tambah</a>
            <a href="{{ route('tx.subtotal') }}" class="btn btn-secondary">Lihat Subtotal</a>
        </div>
    </div>

    <div class="rounded-lg border border-gray-200">
        <div class="overflow-x-auto rounded-t-lg">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            No
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Tipe
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Nama
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            No Telepon
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Jumlah
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Acara
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Tanggal
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Bukti
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-center">
                    @forelse ($txes as $key => $tx)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $key + 1 }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $tx->type }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $tx->name }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $tx->phone }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $tx->getFormattedAmount() }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $tx->events }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $tx->date->format('d M Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                @if ($tx->proof)
                                    <button
                                        onclick="Swal.fire({
                                        title: 'Foto Bukti',
  imageUrl: @js(asset('storage/' . $tx->proof)),
});
"
                                        class="w-12 mask mask-squircle">
                                        <img class="object-cover" src="{{ asset('storage/' . $tx->proof) }}"
                                            alt="Tidak ada Bukti">
                                    </button>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                <a href="{{ route('tx.edit', $tx->id) }}" class="btn btn-sm btn-info">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        </tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                            Belum ada catatan
                        </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>



        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2 divide-y ">
            <div class="flex w-full justify-between flex-wrap gap-1">
                <p>Total QRIS : {{ 'Rp ' . number_format($txSum->totalTypeQris, 2, '.', ',') }}</p>
                <span>Periode : {{ $txSum->rangeTotalQris[0]?->format('d M Y') }} -
                    {{ $txSum->rangeTotalQris[1]?->format('d M Y') }}</span>
                <span>Dari jumlah : {{ $txSum->typeQrisCount }}</span>
            </div>
            <div class="flex w-full justify-between flex-wrap gap-1">
                <p>Total Tunai : {{ 'Rp ' . number_format($txSum->totalTypeCash, 2, '.', ',') }}</p>
                <span>Periode : {{ $txSum->rangeTotalCash[0]?->format('d M Y') }} -
                    {{ $txSum->rangeTotalCash[1]?->format('d M Y') }}</span>
                <span>Dari jumlah : {{ $txSum->typeCashCount }}</span>
            </div>
            <div class="flex w-full justify-between flex-wrap gap-1">
                <p class="font-bold">Total Semua : {{ 'Rp ' . number_format($txSum->totalTx, 2, '.', ',') }}</p>
                <span>Periode : {{ $txSum->rangeTotalTx[0]?->format('d M Y') }} -
                    {{ $txSum->rangeTotalTx[1]?->format('d M Y') }}</span>
                <span>Jumlah semua : {{ $txSum->txesCount }}</span>
            </div>
        </div>


        @if ($txes->hasPages())
            <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                {{ $txes->links() }}
            </div>
        @endif
    </div>

</div>
