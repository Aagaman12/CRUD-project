@extends('layouts.app')
@section('title', 'User List')

@section('content')

    <div class="max-w-7xl mx-auto px-margin py-space-lg">


        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-lg">
            <div>
                <div class="flex items-center gap-space-xs mb-1">
                    <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">User
                        System</span>
                </div>
                @if (!request()->deleted)
                    <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Users (Assign roles to users)
                @else
                        <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Deleted Users
                    @endif
                    </h1>
            </div>
            @if (!request()->deleted)
                <a href="{{ route('users.index', ['deleted' => 1]) }}"
                    class="inline-flex items-center justify-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-secondary transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-lg">add</span>
                    <span>DELETED USER</span>
                </a>
            @endif

            @if (request()->deleted)
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center justify-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-secondary transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    <span>BACK TO USERS</span>
                </a>
            @endif

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
                            <th class="py-space-md px-space-md">E-mail</th>
                            <th class="py-space-md px-space-md">Roles</th>
                            <th class="py-space-md px-space-md">Registered at</th>
                            <th class="py-space-md px-space-md">Actions</th>

                        </tr>
                    </thead>

                    <tbody class="text-on-surface divide-y divide-surface-variant/20 ">
                        @forelse ($users as $user)
                            <tr class="hover:bg-surface-container-low transition-colors ">
                                <td
                                    class="py-space-sm px-space-md font-label-md text-label-md font-medium text-on-surface-variant">
                                    {{ $user->id }}
                                </td>
                                <td class="py-space-sm px-space-md font-medium">{{ $user->name }}</td>
                                <td class="py-space-sm px-space-md font-medium">{{ $user->email }}</td>
                                <td class="py-space-sm px-space-md font-medium">{{ $user->roles->pluck('name')->implode(', ') }}
                                </td>
                                <td class="py-space-sm px-space-md font-medium">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y')  }}
                                </td>

                                <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                    <div class="inline-flex items-center gap-space-xs font-label-sm text-label-sm">
                                        @if (!request()->deleted)
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="text-on-surface-variant hover:text-on-surface px-1 py-0.5">Edit
                                            </a>
                                            <span class="text-surface-container-highest">/</span>
                                        @endif

                                        @if (request()->deleted == 1)
                                            <form method="POST" action="{{ route('users.restore', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-primary-container hover:text-red-600 px-1 py-0.5 cursor-pointer">
                                                    Restore
                                                </button>
                                            </form>
                                        @else
                                            <form method="post" action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?');"
                                                class="inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="text-primary-container hover:text-red-600 px-1 py-0.5 cursor-pointer">Delete
                                                </button>
                                            </form>
                                        @endif

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
        <div>{{ $users->links() }}</div>
    </div>

@endsection