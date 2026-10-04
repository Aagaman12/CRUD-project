@extends('layouts.app')
@section('title', 'Category Details')

@section('content')
<div class="max-w-md mx-auto px-margin w-full py-space-xl min-h-[calc(100vh-13rem)] flex flex-col items-center justify-center gap-space-md">

    <a href="{{ route('categories.index') }}"
       class="self-start inline-flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        Back to Categories
    </a>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-xl w-full flex flex-col items-center text-center gap-space-md">

        <div class="w-14 h-14 rounded-full bg-primary-container/10 flex items-center justify-center text-primary-container">
            <span class="material-symbols-outlined text-2xl">category</span>
        </div>

        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface">{{ $category->name }}</h1>
            <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mt-1">Category</p>
        </div>

        <div class="w-full border-t border-surface-variant/40 pt-space-md">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Description</span>
            <p class="font-body-md text-body-md text-on-surface mt-1">
                {{ $category->description ?? 'No description provided.' }}
            </p>
        </div>

        <a href="{{ route('categories.edit', $category) }}"
           class="w-full inline-flex items-center justify-center gap-space-xs py-space-sm px-space-lg rounded-lg font-label-lg text-label-lg bg-primary-container hover:bg-primary text-on-primary shadow-sm transition-all mt-space-sm">
            <span class="material-symbols-outlined text-lg">edit</span>
            Edit Category
        </a>

    </div>
</div>
@endsection