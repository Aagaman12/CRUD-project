@extends('layouts.app')
@section('title', 'Login Page')

@section('content')

<form action="{{ route('login') }}" method="post">
    @csrf

    <h2>Log in</h2>

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
<input type ="text" placeholder="Enter your username" name ="name" value = "{{ old ('name') }}" required/><br>
<label>
    Password
</label>
<input type ="password" placeholder="Enter your Password" name ="password" required/><br>

<input type ="submit" value ="Login"/>
</form>

@endsection