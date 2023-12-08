<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <h1 class="text-2xl font-semibold">Ubah peran user</h1>

                <div class="divider"></div>

                <div class="overflow-x-auto h-96">
                    <table class="table table-pin-rows">
                        <tbody>
                            <tr>
                                <td>Nama : {{ $user->name }}</td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>Email : {{ $user->email }}</td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="{{ route('admin.update-user-role', $user->id) }}" method="POST">

                                        @csrf
                                        @method('put')

                                        <p>Pilih roles untuk di assign</p>
                                        <select name="roles[]"
                                            class="select select-bordered w-full max-w-xs select-multiple" multiple
                                            autofocus>
                                            @foreach ($roles as $role)
                                                <option {{ Auth::user()->hasRole($role->name) ? 'selected' : '' }}
                                                    value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="w-full max-w-xs py-2 flex justify-between">
                                            <button class="btn btn-success">Simpan</button>
                                            <button href="javascript:history.back()"
                                                class="btn btn-error">Batal</button>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
