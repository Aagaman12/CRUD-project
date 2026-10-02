<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::orderBy('created_at', 'asc')->paginate(10);

        return view('roles.index', ['roles' => $roles]);
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('roles.create', ['permissions' => $permissions]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
        ]);
        $role = Role::create($data);         // stores our permission into database.
        if (! empty($request->permission)) {
            foreach ($request->permission as $name) {
                $role->givePermissionTo($name);
            }
        }

        return redirect(route('roles.index'))->with('success', 'Role Added Successfully.');

    }

    public function edit(Role $role): View
    {
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('roles.edit', ['permissions' => $permissions, 'hasPermissions' => $hasPermissions, 'role' => $role]);
    }

    public function update(Request $request, string $role): RedirectResponse
    {
        $role = Role::findOrFail($role);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($role->id)],
        ]);

        $role->update($data);

        if (! empty($request->permission)) {
            $role->syncPermissions($request->permission);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        try {
            $role->delete();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Role deleted successfully.');
        } catch (QueryException) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'This Role cannot be deleted.');
        }
    }
}
