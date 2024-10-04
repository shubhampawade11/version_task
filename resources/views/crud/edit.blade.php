
@extends('layouts.app')

@section('title', 'User Index')

@section('content')
<h1>Edit user details</h1>
<form id="userUpdateForm" action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="userdetail">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ $user->username }}">

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phonenumber" value="{{ $user->phonenumber }}">

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="{{ $user->password }}">

        <button type="submit">Update</button>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#userUpdateForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: $(this).attr('action'), // Get the form action URL
            method: 'POST', // Use POST method
            data: $(this).serialize(),
             // Serialize the form data
            success: function(response) {
                // Handle the successful response
                alert('User updated successfully!');
                window.location.href = '/user' ;
                // You can redirect or update the UI as needed
            },
            error: function(xhr) {
                // Handle any errors
                if (xhr.status === 422) { // Validation error
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for (const key in errors) {
                        errorMessage += errors[key].join(', ') + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
});
</script>

@endsection
