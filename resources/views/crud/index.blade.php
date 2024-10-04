
@extends('layouts.app')

@section('title', 'User Index')

@section('content')
   <h1>User Details</h1>
   <label for="nameFilter" class="filter-label">Filter by Name:</label>
<select id="nameFilter" class="name-filter">
    <option value="">All</option>
    <!-- Dynamic options will be populated here -->
</select>
    <table class="usertabled" id="users-table" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>UserName</th>
                <th>PhoneNumber</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

   
@endsection
