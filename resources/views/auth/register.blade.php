@extends('layouts.app')
@section('title', 'Register Page')

@section('content')

<form action="{{ route('register') }}" method="post">
    @csrf

    <h2>Register</h2>
<label>
    Username
</label>
<input type ="text" placeholder="Enter your username" name ="name" value = "{{ old ('name') }}" required/><br>
<label>
    Email
</label>
<input type ="email" placeholder="Enter your Email." name ="username" value = "{{ old ('email') }}" required/><br>
<label>
    Password
</label>
<input type ="password" placeholder="Enter your Password" name ="password" required/><br>
<label>
   Confirm Password
</label>
<input type ="password" placeholder="Re-enter your Password" name ="password_confirmation" required/><br>

<input type ="submit" value ="Login"/>
</form>

@endsection