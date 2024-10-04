@extends('layouts.app')

@section('title', 'User Index')

@section('content')

<h2>User Information</h2>
<div id="responseMessage"></div>
<form action="{{ route('store') }}" method="post" id="userForm">
    @csrf
    <div class="userdetail">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <div class="error-message" id="nameError"></div>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <div class="error-message" id="usernameError"></div>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phonenumber">
        <div class="error-message" id="phonenumberError"></div>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email">
        <div class="error-message" id="emailError"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <div class="error-message" id="passwordError"></div>
    </div>

    <h2>Product Details</h2>
    <div class="add-row" onclick="addProductRow()">Add Row</div>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Product Type</th>
                <th>Discount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="product-rows">
            <tr>
                <td>
                    <input type="text" name="product_name[]">

                </td>
                <td>
                    <input type="number" name="product_price[]" step="0.01">

                </td>
                <td>
                    <input type="number" name="product_quantity[]">

                </td>
                <td>
                    <select name="product_type[]" onchange="handleProductTypeChange(this)">
                        <option value="" disabled selected>Select</option>
                        <option value="flat">Flat</option>
                        <option value="discount">Discount</option>
                    </select>

                </td>
                <td>
                    <input type="text" id="discount-input" name="discount[]" placeholder="Discount (%)" disabled oninput="updateTotal()">

                </td>
                <td>
                    <i class="fas fa-trash remove-icon" onclick="removeProductRow(this)">X</i>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td><span id="total-price">0.00</span> INR</td>
            </tr>
        </tfoot>
    </table>

    <button type="submit">Submit</button>
    <a href="/user">user dashboard</a>

</form>

@endsection