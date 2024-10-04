<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        label {
            margin-right: 10px;
            font-weight: bold;
        }
        select {
            padding: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        @media (max-width: 600px) {
            th, td {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <main>
        @yield('content')
    </main>
    <script>
$(document).ready(function() {
    
    function fetchUsers(nameFilter) {
        console.log(nameFilter);
        $.ajax({
            url: '/get-data', 
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { name: nameFilter }, 
            success: function(data) {
                let rows = '';
                console.log(data); 
                data.forEach(user => {
                    rows += `<tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.username}</td>
                        <td>${user.phonenumber}</td>
                        <td>${user.email}</td>
                        <td>${user.password}</td> <!-- Masked password for security -->
                        <td>
                            <a href="/user/${user.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-user" data-id="${user.id}">Delete</button>
                        </td>
                    </tr>`;
                });
                $('#users-table tbody').html(rows); 
            },
            error: function(xhr) {
                console.error('Error fetching data:', xhr);
                alert('Failed to fetch users. Please try again.'); 
            }
        });
    }

    
    fetchUsers();

   
    $.ajax({
        url: '/users/names',
        method: 'GET',
        success: function(data) {
           
            $('#nameFilter').empty().append('<option value="">All</option>'); 
            
           
            data.forEach(item => {
                $('#nameFilter').append(`<option value="${item.name}">${item.name}</option>`);
                console.log("Fetched name:", item.name); 
            });
        },
        error: function(xhr) {
            console.error('Error fetching names:', xhr);
            alert('Failed to fetch names. Please try again.'); 
        }
    });

    
    $('#nameFilter').change(function() {
        const selectedName = $(this).val();
        console.log("hello",selectedName);
        fetchUsers(selectedName); 
    });

   
    $(document).on('click', '.delete-user', function() {
        const userId = $(this).data('id'); 
        const button = $(this); 
        
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: '/user/' + userId, 
                method: 'POST', 
                data: {
                    _method: 'DELETE', 
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    alert('User deleted successfully!');
                    button.closest('tr').remove(); 
                },
                error: function(xhr) {
                    
                    alert('An error occurred while deleting the user. Please try again.');
                    console.error('Error deleting user:', xhr); 
                }
            });
        }
    });
});
</script>
