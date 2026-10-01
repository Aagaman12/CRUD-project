@extends('layouts.app')
@section('title', 'Register Page')

@section('content')

    <form action="{{ route('register') }}" method="post">
        @csrf

        <h2>Register</h2>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label>
            Username
        </label>
        <input type="text" placeholder="Enter your username" name="name" value="{{ old('name') }}" /><br>
        <label>
            Email
        </label>
        <input type="email" placeholder="Enter your Email." name="email" value="{{ old('email') }}" /><br>
        <label>
            Password
        </label>
        <input type="password" placeholder="Enter your Password" name="password" /><br>
        <label>
            Confirm Password
        </label>
        <input type="password" placeholder="Re-enter your Password" name="password_confirmation" /><br>

        <input type="submit" value="Register" />

    </form>

@endsection