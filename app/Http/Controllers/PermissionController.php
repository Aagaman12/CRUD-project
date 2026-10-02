<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
}
