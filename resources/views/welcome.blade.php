<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h2>User Information</h2>
<form action="#" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="phone">Phone Number:</label><br>
    <input type="tel" id="phone" name="phone" required><br><br>

    <label for="email">Email Address:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <h2>Product Details</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Product Type</th>
                <th>Discount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="product_name[]" required></td>
                <td><input type="number" name="product_price[]" required step="0.01"></td>
                <td><input type="number" name="product_quantity[]" required></td>
                <td>
                    <select name="product_type[]">
                        <option value="flat">Flat</option>
                        <option value="discount">Discount</option>
                    </select>
                </td>
                <td><input type="text" name="discount[]" placeholder="Enter discount"></td>
            </tr>
            <!-- You can add more rows as needed -->
        </tbody>
    </table>
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
