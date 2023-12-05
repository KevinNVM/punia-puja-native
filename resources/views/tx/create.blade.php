<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <h1 class="text-xl font-semibold">Tambah catatan baru</h1>

                <form method="POST" action="{{ route('tx.store') }}" class="mt-4" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <p>Tipe</p>
                        <select name="type" class="w-full max-w-xs select select-bordered">
                            <option value="cash">Tunai</option>
                            <option value="qris">QRIS</option>
                        </select>
                        @error('type')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Nama</p>
                        <input type="text" name="name" class="input input-bordered max-w-xs w-full" required>
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>No Telepon</p>
                        <input type="tel" name="phone" class="input input-bordered max-w-xs w-full">
                        @error('phone')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Jumlah</p>
                        <input type="number" name="amount" class="input input-bordered max-w-xs w-full">
                        @error('amount')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Acara (opsional)</p>
                        <input type="text" name="events" class="input input-bordered max-w-xs w-full" />
                        @error('events')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{
                        getCurrentDate() {
                            const today = new Date();
                            const year = today.getFullYear();
                            const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                            const day = String(today.getDate()).padStart(2, '0');
                    
                            const formattedDate = `${year}-${month}-${day}`;
                            return formattedDate;
                        }
                    }">
                        <p>Tanggal</p>
                        <input type="date" name="date" class="input input-bordered max-w-xs w-full"
                            :value="getCurrentDate()">
                        @error('date')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <p>Bukti (opsional)</p>
                        <input type="file" class="file-input w-full max-w-xs input-bordered" name="proof" />
                        @error('proof')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-3 flex justify-between">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="javascript:history.back()" class="btn btn-error">Batal</a>
                    </div>


                </form>



            </div>
        </div>
    </div>
</x-app-layout>
