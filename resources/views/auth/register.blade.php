@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto px-margin w-full py-space-xl">

    <div class="flex flex-col items-center gap-space-xs mb-space-lg text-center">
        <span class="material-symbols-outlined text-primary-container text-4xl">inventory_2</span>
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Register</h2>
    </div>

    <form action="{{ route('register') }}" method="post"
          class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md">
        @csrf

        @if ($errors->any())
            <div class="px-space-md py-space-sm rounded-lg bg-error-container/60 text-error font-label-md text-label-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col gap-space-xs">
            <label class="font-label-lg text-label-lg text-on-surface">Username</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your username"
                   class="w-full px-space-md py-space-sm rounded-lg bg-surface text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
        </div>

        <div class="flex flex-col gap-space-xs">
            <label class="font-label-lg text-label-lg text-on-surface">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your Email."
                   class="w-full px-space-md py-space-sm rounded-lg bg-surface text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
        </div>

        <div class="flex flex-col gap-space-xs">
            <label class="font-label-lg text-label-lg text-on-surface">Password</label>
            <input type="password" name="password" placeholder="Must be 8 characters."
                   class="w-full px-space-md py-space-sm rounded-lg bg-surface text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
        </div>

        <div class="flex flex-col gap-space-xs">
            <label class="font-label-lg text-label-lg text-on-surface">Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Re-enter your Password"
                   class="w-full px-space-md py-space-sm rounded-lg bg-surface text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner transition-colors" />
        </div>

        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-space-xs py-space-sm px-space-md rounded-lg font-label-lg text-label-lg bg-primary-container hover:bg-primary text-on-primary shadow-sm transition-all mt-space-sm">
            <span class="material-symbols-outlined text-lg">person_add</span>
            Register
        </button>
    </form>

    <p class="text-center font-body-sm text-body-sm text-on-surface-variant mt-space-md">
        Already have an account?
        <a href="{{ route('show.login') }}" class="text-primary-container font-medium hover:underline">Log in</a>
    </p>
</div>
@endsection