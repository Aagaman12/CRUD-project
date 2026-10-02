<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permission = Permission::orderBy('created_at', 'desc')->paginate(10);

        return view('permissions.index', ['permissions' => $permission]);
    }

    public function create(): View
    {
        return view('permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name',
        ]);
        Permission::create($data);         // stores our permission into database.

        return redirect(route('permissions.index'))->with('success', 'Permission Added Successfully.');

    }

    public function edit(Permission $permission): View
    {

        return view('permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, string $permission): RedirectResponse
    {
        $permission = Permission::findOrFail($permission);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('permissions', 'name')->ignore($permission->id)],
        ]);

        $permission->update($data);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        try {
            $permission->delete();

            return redirect()
                ->route('permissions.index')
                ->with('success', 'Permission deleted successfully.');
        } catch (QueryException) {
            return redirect()
                ->route('permission.index')
                ->with('error', 'This Permission cannot be deleted.');
        }
    }
}
