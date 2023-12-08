<?php

namespace App\Http\Controllers;

use Gate;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    function index()
    {
        return view('admin.index', [
            'roles' => Role::all(),
        ]);
    }

    public function editRoles(User $user)
    {

        return view('admin.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function updateUserRoles(Request $request, User $user)
    {
        Gate::authorize('deny-all');

        $validated = $request->validate(
            ['roles' => 'required']
        );

        if (!Auth::user()->hasRole('super-admin')) {
            $validated['roles'] = array_filter(Role::pluck('name')->toArray(), function ($role) {
                return $role !== 'super-admin';
            });
        }

        $user->syncRoles($validated['roles']);

        return redirect()
            ->to(route('admin.index'))
            ->with('flash', [
                'banner' => 'User roles telah di-update!',
                'bannerStyle' => 'success'
            ]);
    }

    public function createNewUser(Request $request)
    {
        Gate::authorize('deny-all');


        $validated = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|alpha_dash',
                'roles' => 'required'
            ]
        );

        $validated['email_verified_at'] = now();
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        $user->assignRole($validated['roles']);

        return redirect()
            ->to(route('admin.index'))
            ->with('flash', [
                'banner' => 'User baru berhasil di-buat!',
                'bannerStyle' => 'success'
            ]);
    }

    function deleteUser(User $user)
    {
        Gate::authorize('deny-all');

        if ($user->id !== Auth::user()->id)
            $user->deleteOrFail();

        return redirect()
            ->to(route('admin.index'))
            ->with('flash', [
                'banner' => 'User berhasil di-hapus!',
                'bannerStyle' => 'success'
            ]);
    }
}
