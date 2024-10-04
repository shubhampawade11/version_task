<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>


    <main>
        @yield('content')
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault();


                $('.error-message').html('');


                let formData = $(this).serialize();


                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#responseMessage').html('<p style="color: green;">' + response.message + '</p>');
                        $('#userForm')[0].reset();
                        document.getElementById('total-price').innerText = '0.00';
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;

                        for (let field in errors) {
                            if (field.includes('product-')) {

                                const className = field.replace('.', '-');
                                $('.' + className + '-error').html(errors[field].join('<br>'));
                            } else {

                                $('#' + field + 'Error').html(errors[field].join('<br>'));
                            }
                        }

                    }
                });
            });
        });

        function addProductRow() {

            const newRow = `
            <tr>
                <td>
                    <input type="text" name="product_name[]">
                    <div class="error-message product-name-error"></div>
                </td>
                <td>
                    <input type="number" name="product_price[]" step="0.01">
                    <div class="error-message product-price-error"></div>
                </td>
                <td>
                    <input type="number" name="product_quantity[]">
                    <div class="error-message product-quantity-error"></div>
                </td>
                <td>
                    <select name="product_type[]" onchange="handleProductTypeChange(this)">
                        <option value="" disabled selected>Select</option>
                        <option value="flat">Flat</option>
                        <option value="discount">Discount</option>
                    </select>
                    <div class="error-message product-type-error"></div>
                </td>
                <td>
                    <input type="text" name="discount[]" placeholder="Enter discount" disabled oninput="updateTotal()">
                    <div class="error-message product-discount-error"></div>
                </td>
                <td>
                    <i class="fas fa-trash remove-icon" onclick="removeProductRow(this)">X</i>
                </td>
            </tr>
        `;
            $('#product-rows').append(newRow);
        }

        function removeProductRow(element) {
            $(element).closest('tr').remove();
        }

        function handleProductTypeChange(select) {
            const discountInput = $(select).closest('tr').find('input[name="discount[]"]');
            if ($(select).val() === 'flat') {
                discountInput.prop('disabled', true);

            } else {
                discountInput.prop('disabled', false).val('');
            }
            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            const productRows = document.querySelectorAll('#product-rows tr');

            productRows.forEach(row => {
                const price = parseFloat(row.querySelector('input[name="product_price[]"]').value) || 0;
                const quantity = parseInt(row.querySelector('input[name="product_quantity[]"]').value) || 0;
                const discountInput = row.querySelector('input[name="discount[]"]');
                const discountType = row.querySelector('select[name="product_type[]"]').value;
                let discount = parseFloat(discountInput.value) || 0;


                let discountAmount = 0;
                if (discountType === 'discount') {
                    discountAmount = (price * discount / 100) * quantity;
                }

                const totalPriceForRow = (price * quantity) - discountAmount;
                total += totalPriceForRow;
            });

            document.getElementById('total-price').innerText = total.toFixed(2);

        }
    </script>

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
    <!-- Add other necessary scripts -->
</body>

</html>