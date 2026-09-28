@extends('layouts.app')
@section('title', 'Category Details')

@section('content')
<div class="max-w-3xl mx-auto px-margin py-space-lg">
    <div class="flex items-center gap-space-sm mb-space-lg">
        <a href="{{ route('categories.index') }}" title="Back to Categories"
           class="flex items-center justify-center w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition-colors">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
        </a>
        <h1 class="font-headline-lg text-headline-lg text-on-surface">{{ $category->name }}</h1>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
        <div>
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Description</span>
            <p class="font-body-md text-body-md text-on-surface mt-1">
                {{ $category->description ?? 'No description provided.' }}
            </p>
        </div>

        <div class="flex gap-space-sm pt-space-sm">
            <a href="{{ route('categories.edit', $category) }}"
               class="inline-flex items-center justify-center py-space-sm px-space-lg rounded-lg font-label-lg text-label-lg bg-primary-container hover:bg-primary text-on-primary shadow-sm transition-all">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection