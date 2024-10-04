<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .edit-link {
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid transparent;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .edit-link:hover {
            background-color: #007bff;
            color: white;
        }

        .delete-form {
            display: inline;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>

</head>

<body>
    <h1>User Management</h1>

    <form id="searchForm" method="GET" action="{{ route('search') }}">
        @csrf
        <input type="text" id="search" name="search" placeholder="Search users..." value="{{ request()->get('search') }}">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>User Name</th>
                <th>Phone Number</th>
                <th>Email ID</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="product-rows">
            @foreach ($user as $users)
            <tr>
                <td>{{ $users->name }}</td>
                <td>{{ $users->username }}</td>
                <td>{{ $users->phonenumber }}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->password }}</td>
                <td>
                    <a href="{{ route('user.edit', $users) }}" class="edit-link">Edit</a>
                    <form action="{{ route('user.destroy', $users) }}" method="POST" class="delete-form" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>