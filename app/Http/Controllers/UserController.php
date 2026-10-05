<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->deleted == 1) {
            $users = User::onlyTrashed()->latest()->paginate(10);
        } else {
            $users = User::query()->latest()->paginate(10);
        }

        return view('users.index', ['users' => $users]);
    }

    public function edit(string $id): View
    {
        $roles = Role::orderBy('name', 'asc')->get();
        $user = User::findOrFail($id);
        $hasRoles = $user->roles->pluck('id');

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'hasRoles' => $hasRoles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $data = $request->validate([           // Validate the users
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        $user->update($data);

        if (! empty($request->role)) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();

            return redirect()
                ->route('users.index')
                ->with('success', 'User deleted successfully.');
        } catch (QueryException) {
            return redirect()
                ->route('users.index')
                ->with('error', 'This User cannot be deleted.');
        }
    }

    public function restore(int $user): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($user);
        $user->restore();

        return redirect()
            ->route('users.index')
            ->with('success', 'User restored successfully.');
    }
}
