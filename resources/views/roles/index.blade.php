@extends('layouts.app')
@section('title', 'Permission List')

@section('content')

    <div class="max-w-7xl mx-auto px-margin py-space-lg">


        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-lg">
            <div>
                <div class="flex items-center gap-space-xs mb-1">
                    <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Roles
                        System</span>
                </div>
                <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Roles (Admin, Customer and Super
                    Admin)</h1>
            </div>
            <a href="{{ route('roles.create') }}"
                class="inline-flex items-center justify-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-secondary transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>CREATE A ROLE</span>
            </a>
        </div>

        <x-sessionMessage></x-sessionMessage>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-md">
            <div class="overflow-x-auto">
                <table class="w-full text-center font-body-md text-body-md">
                    <thead>
                        <tr
                            class="bg-surface-container text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                            <th class="py-space-md px-space-md">Id</th>
                            <th class="py-space-md px-space-md">Name</th>
                            <th class="py-space-md px-space-md">Permissions</th>
                            <th class="py-space-md px-space-md">Actions</th>

                        </tr>
                    </thead>
                    <tbody class="text-on-surface divide-y divide-surface-variant/20 ">
                        @forelse ($roles as $role)
                            <tr class="hover:bg-surface-container-low transition-colors ">
                                <td
                                    class="py-space-sm px-space-md font-label-md text-label-md font-medium text-on-surface-variant">
                                    {{ $role->id }}
                                </td>
                                <td class="py-space-sm px-space-md font-medium">{{ $role->name }}</td>
                                <td class="py-space-sm px-space-md font-medium">
                                    {{ $role->permissions->pluck('name')->implode(', ') }}
                                </td>

                                <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                    <div class="inline-flex items-center gap-space-xs font-label-sm text-label-sm">
                                        <a href="{{ route('roles.edit', $role) }}"
                                            class="text-on-surface-variant hover:text-on-surface px-1 py-0.5">Edit</a>
                                        <span class="text-surface-container-highest">/</span>
                                        <form method="post" action="{{ route('roles.destroy', $role) }}"
                                            onsubmit="return confirm('Are you sure you want to delete {{ $role->name }}?');"
                                            class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="text-primary-container hover:text-red-600 px-1 py-0.5 cursor-pointer">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                



                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-on-surface-variant">No Permissions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div>{{ $roles->links() }}</div>
    </div>

@endsection