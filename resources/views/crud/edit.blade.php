
@extends('layouts.app')

@section('title', 'User Index')

@section('content')
<h1>Edit user details</h1>
<form action="{{ route('user.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    

    <div class="userdetail">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $user->name }}"  >

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="{{ $user->username }}" >

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phonenumber" value="{{ $user->phonenumber }}" >

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" value="{{ $user->email }}" >

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="{{ $user->password }}" >

    <button type="submit">Update</button>
</form>

@endsection
