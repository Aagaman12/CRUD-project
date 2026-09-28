@extends('layouts.app')
@section('title', 'Categories')

@section('content')
   <div class="max-w-7xl mx-auto px-margin py-space-lg">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-lg">
            <div>
                <div class="flex items-center gap-space-xs mb-1">
                    <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Inventory
                        System</span>
                </div>
                <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight">Categories</h1>
            </div>
            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center justify-center gap-space-xs bg-primary-container text-on-primary px-space-lg py-space-sm rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-secondary transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>CREATE A CATEGORY</span>
            </a>
        </div>

        @if(session()->has('success'))
            <div
                class="mb-space-md px-space-md py-space-sm rounded-lg bg-primary-container/10 text-primary-container font-label-md text-label-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left font-body-md text-body-md">
                    <thead>
                        <tr
                            class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                            <th class="py-space-md px-space-md">Id</th>
                            <th class="py-space-md px-space-md">Name</th>
                            <th class="py-space-md px-space-md">Description</th>
                            <th class="py-space-md px-space-md text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-on-surface divide-y divide-surface-variant/20">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td
                                    class="py-space-sm px-space-md font-label-md text-label-md font-medium text-on-surface-variant">
                                    {{ $category->id }}</td>
                                <td class="py-space-sm px-space-md font-medium">{{ $category->name }}</td>
                                <td class="py-space-sm px-space-md text-on-surface-variant max-w-md">
                                    <p class="line-clamp-2">{{ $category->description }}</p>
                                </td>
                                <td class="py-space-sm px-space-md text-center whitespace-nowrap">
                                    <div class="inline-flex items-center gap-space-xs font-label-sm text-label-sm">
                                        <a href="{{ route('categories.show', $category) }}"
                                            class="text-tertiary hover:underline px-1 py-0.5">Show</a>
                                        <span class="text-surface-container-highest">/</span>
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-on-surface-variant hover:text-on-surface px-1 py-0.5">Edit</a>
                                        <span class="text-surface-container-highest">/</span>
                                        <form method="post" action="{{ route('categories.destroy', $category) }}"
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
                                <td colspan="4" class="py-12 text-center text-on-surface-variant">No categories yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>{{ $categories->links() }}</div>
    </div>
@endsection
