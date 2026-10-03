@extends('layouts.app')
@section('title', 'Create Permission')

@section('content')


    <div class="w-full bg-surface-container-lowest shadow-sm mb-space-lg">
        <div
            class="max-w-7xl mx-auto px-margin py-space-md flex flex-col md:flex-row md:items-center justify-between gap-space-sm">
            <div class="flex flex-col gap-space-xs">
                <nav
                    class="flex items-center gap-space-xs font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
                    <a href="{{ route('roles.index') }}" class="hover:text-primary transition-colors">Roles</a>
                    <span class="text-outline">/</span>
                    <span class="text-primary font-semibold">Update Role</span>
                </nav>
                <div class="flex items-center gap-space-sm">
                    <a href="{{ route('roles.index') }}" title="Back to Roles"
                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                    </a>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">Edit a Role</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-margin w-full py-space-lg min-h-[calc(100vh-13rem)] flex items-center">

        <form method="post" action="{{ route('roles.update', $role) }}" class="flex flex-col gap-space-lg w-full">
            @csrf
            @method('put')
            <x-errorMessage>

            </x-errorMessage>

            <div class=" flex flex-col gap-space-lg">

                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div class="flex items-center gap-space-xs pb-space-xs">
                        <span class="w-2 h-4 bg-primary-container rounded-sm"></span>
                        <h2 class="font-headline-md text-headline-md text-on-surface">General Information</h2>
                    </div>

                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-lg text-label-lg text-on-surface">Role Name</label>
                        <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder=""
                            class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />

                    </div>
                    <div class="flex flex-col gap-space-xs">
                        <label class="font-label-lg text-label-lg text-on-surface">
                            Permissions
                        </label>

                        <div class="flex flex-wrap gap-space-sm">
                            @foreach ($permissions as $permission)
                                <label
                                    class="flex items-center gap-space-xs text-on-surface font-body-md text-body-md cursor-pointer">
                                    <input {{ ($hasPermissions->contains($permission->name)) ? 'checked' : '' }} type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                        class="rounded text-primary-container focus:ring-primary-container/30">
                                    <span>{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>


                <div class="flex flex-col gap-space-sm pt-space-md">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-space-xs py-space-sm px-space-md rounded-lg font-label-lg text-label-lg bg-primary-container hover:bg-primary text-on-primary shadow-sm transition-all">
                        <span class="material-symbols-outlined text-lg">check_circle</span>
                        Save &amp; Publish Role
                    </button>
                    <a href="{{ route('roles.index') }}"
                        class="w-full inline-flex items-center justify-center py-space-sm px-space-md rounded-lg font-label-lg text-label-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors">
                        Cancel and Return
                    </a>
                </div>



            </div>

        </form>
    </div>

@endsection