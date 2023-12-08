<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <h1 class="text-2xl font-semibold">Selamat datang!</h1>

                <div class="divider"></div>


                <div class="w-full flex justify-between">
                    <h2 class="text-xl font-semibold leading-tight">Roles</h2>
                    {{-- <a href="" class="btn btn-sm btn-primary">Tambah</a> --}}
                </div>
                <div class="flex flex-col gap-2">
                    @foreach ($roles as $role)
                        <details class="collapse bg-base-200">
                            <summary class="collapse-title tx-lg font-medium">
                                {{ $role->name }}
                            </summary>
                            <div class="collapse-content">
                                <ul>
                                    <li>Users:</li>
                                    @forelse ($role->users as $user)
                                        <li>- {{ $user->name }}</li>
                                    @empty
                                        <li>Tidak ada</li>
                                    @endforelse
                                </ul>
                            </div>
                        </details>
                    @endforeach
                </div>

                <div class="divider">Assign Role</div>

                @livewire('user-table')

                <div class="divider">Add New User</div>

                <form action="{{ route('admin.create-user') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <p>Nama</p>
                        <input type="text" name="name" class="input input-bordered max-w-xs w-full" required>
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Email</p>
                        <input type="email" name="email" class="input input-bordered max-w-xs w-full" required>
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Roles (pilih minimal 1)</p>
                        <select name="roles[]" class="select select-bordered w-full max-w-xs select-multiple" multiple
                            autofocus>
                            @foreach ($roles as $role)
                                @if (!Auth::user()->hasRole('super-admin') && $role->name == 'super-admin')
                                    @continue
                                @endif
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <p>Password</p>
                        <input type="password" name="password" class="input input-bordered max-w-xs w-full" required>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn">Simpan User</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
