@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Order</h1>
        <!-- Your order creation form goes here -->
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
        
            <label for="customer">Customer:</label>
            <select name="customer" id="customer" class="form-control">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        
            <table id="products_table">
                <!-- Table header with column names -->
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Free</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th></th>
                    <!-- Add more columns as needed -->
                </tr>
                <!-- Table rows for products -->
                <!-- Each row represents one product -->
                <tr class="product_row">
                    <td>
                        <select name="products[0][product_id]" class="product_select">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="products[0][quantity]" class="product_quantity">
                    </td>
                    <td>
                        <input type="text" name="products[0][free]" class="product_free" readonly>
                    </td>
                    <td>
                        <input type="number" name="products[0][price]" class="product_price" readonly>
                    </td>
                    <td>
                        <input type="text" name="products[0][amount]" class="product_amount" readonly>
                    </td>
                    <td>
                        <button type="button" class="delete_product_row btn btn-danger" disabled>Delete Row</button>
                    </td>
                </tr>
                
            </table>
        
            <button type="button" id="add_product_row">Add Product</button>
        
            <label for="net_amount">Net Amount:</label>
            <input type="text" name="net_amount" id="net_amount" readonly>
        
            <button type="submit">Save Order</button>
        </form>
        
    </div>

    <script>
        // Define productPrices variable in the global scope
        var productPrices = {!! json_encode($productPrices) !!};

        // Function to handle row deletion
        function deleteRow(button) {
            var row = button.closest('tr'); // Get the parent row of the button
            row.remove(); // Remove the row from the table
            updateDeleteButtons(); // Update the delete buttons
            updateAmount(); // Update the total amount
        }

        // Function to update delete buttons
        function updateDeleteButtons() {
            var deleteButtons = document.querySelectorAll('.delete_product_row'); // Get all delete buttons
            if (deleteButtons.length === 1) { // If there is only one row
                deleteButtons[0].disabled = true; // Disable the delete button
            } else {
                deleteButtons.forEach(function(button) {
                    button.disabled = false; // Enable all delete buttons
                });
            }
        }

        // Function to calculate amount and update corresponding input
        function calculateAmount(quantityInput) {
            var row = quantityInput.closest('.product_row');
            var priceInput = row.querySelector('.product_price');
            var amountInput = row.querySelector('.product_amount');

            var quantity = parseInt(quantityInput.value) || 0;
            var price = parseFloat(priceInput.value) || 0;

            // Calculate amount
            var amount = quantity * price;

            // Update amount input
            amountInput.value = amount.toFixed(2);
        }

        // Function to calculate net amount
        function calculateNetAmount() {
            var netAmount = 0;
            var amountInputs = document.querySelectorAll('.product_amount');

            amountInputs.forEach(function(amountInput) {
                netAmount += parseFloat(amountInput.value) || 0;
            });

            // Update net amount input
            document.getElementById('net_amount').value = netAmount.toFixed(2);
        }

        // Event listener for adding product rows
        document.getElementById('add_product_row').addEventListener('click', function() {
            var rows = document.querySelectorAll('.product_row');
            var lastRow = rows[rows.length - 1]; // Get the last row
            var newRow = lastRow.cloneNode(true); // Clone the last row
            var index = parseInt(newRow.querySelector('.product_select').name.match(/\[(\d+)\]/)[1]) + 1; // Get the index from the last row and increment it
            var inputs = newRow.querySelectorAll('input, select');
            inputs.forEach(function(input) {
                // Update the name attribute with the new index
                input.name = input.name.replace(/\[(\d+)\]/, '[' + index + ']');
                input.value = ''; // Clear the input value
            });
            document.getElementById('products_table').appendChild(newRow);
            updateDeleteButtons(); // Update delete buttons when adding a row
        });

        // Event listener for deleting product rows
        document.addEventListener('change', function(event) {
            var target = event.target;
            if (target.classList.contains('product_select')) {
                var productId = target.value;
                var row = target.closest('.product_row');
                var priceInput = row.querySelector('.product_price');
                priceInput.value = productPrices[productId] || '';
                // Make AJAX request to fetch free issue information
                fetch('/get-free-issue/' + productId)
                    .then(response => response.json())
                    .then(data => {
                        // Update the free issue quantity field
                        var freeQuantity = data.free_quantity;
                        row.querySelector('.product_free').value = freeQuantity;
                    })
                    .catch(error => console.error('Error:', error));
                    }
        });
        document.addEventListener('input', function(event) {
            // Check if the input event is triggered by a quantity input field
            if (event.target.classList.contains('product_quantity')) {
                calculateAmount(event.target);
                calculateNetAmount(event.target);
            }
        });
    </script>
@endsection
