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
    <!-- Add other necessary scripts -->
</body>

</html>