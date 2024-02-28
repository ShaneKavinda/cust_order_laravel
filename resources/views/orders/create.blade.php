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
                        <th>Discount</th>
                        <th>subtotal</th>
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
                            <input type="number" name="products[0][quantity]" class="product_quantity" id="product_quantity">
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
                            <input type="text" name="products[0][discount]" class="product_discount" readonly>
                        </td>
                        <td>
                            <input type="text" name="products[0][subtotal]" class="product_subtotal" readonly>
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


            // Function to calculate net amount
            function calculateNetAmount() {
                var netAmount = 0;
                var subtotals = document.querySelectorAll('.product_subtotal');

                subtotals.forEach(function(subtotal) {
                    netAmount += parseFloat(subtotal.value) || 0;
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
                // Attach quantity change event listener to the new row
                handleQuantityChange(newRow.querySelector('.product_quantity'));
            });

            function handleQuantityChange(quantityInput) {
                quantityInput.addEventListener('change', function(event) {
                    var row = this.closest('.product_row'); // Use 'this' to refer to the quantity input element
                    var productId = row.querySelector('.product_select').value;
                    var quantity = parseInt(this.value) || 0; // Use 'this' to refer to the quantity input element

                    console.log('Quantity:', quantity);
                    console.log('Product ID:', productId);

                    // Make AJAX request to fetch free issue information
                    fetch('/get-free-issue/' + productId)
                        .then(response => {
                            console.log('AJAX Request Status:', response.status);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Free Issue Data:', data);
                            // Extract required fields from the data object
                            var purchaseQuantity = parseInt(data.purchase_quantity) || 1;
                            var freeQuantity = parseInt(data.free_quantity) || 0;
                            var lowerLimit = parseInt(data.lower_limit) || 0;
                            var upperLimit = parseInt(data.upper_limit) || 0;
                            
                            console.log('Purchase Quantity:', purchaseQuantity);
                            console.log('Free Quantity:', freeQuantity);
                            console.log('Lower Limit:', lowerLimit);
                            //console.log('Upper Limit:', upperLimit);

                            // Check if the free issue type is "multiple"
                            if (data.type === 'multiple') {
                                // Perform integer division and calculate the free quantity
                                var calculatedFreeQuantity = Math.floor(quantity / purchaseQuantity) * freeQuantity;
                                // Check if the calculated free quantity is within the specified limits
                                var finalFreeQuantity;
                                if (quantity > upperLimit){
                                    console.log("Upper limit: ", upperLimit, "Free qty: ", freeQuantity);
                                    finalFreeQuantity = Math.floor(upperLimit/purchaseQuantity) * freeQuantity;
                                } else if (quantity < lowerLimit) {
                                    finalFreeQuantity = 0;
                                } else{
                                    finalFreeQuantity = calculatedFreeQuantity;
                                }
                                console.log('Final Free Quantity:', finalFreeQuantity);
                                row.querySelector('.product_free').value = finalFreeQuantity;
                            } else {
                                row.querySelector('.product_free').value = freeQuantity;
                            }
                             // Fetch price information
                            fetch('/get-product-price/' + productId)
                                .then(response => response.json())
                                .then(priceData => {
                                    var price = parseFloat(priceData.price) || 0;
                                    console.log('Price:', price);
                                    row.querySelector('.product_price').value = price;
                                    // Calculate amount
                                    var amountInput = row.querySelector('.product_amount');
                                    var amount = quantity * price;
                                    // Update amount input
                                    amountInput.value = amount.toFixed(2);
                                    console.log('Amount:', amountInput.value);

                                    // AJAX Request to fetch product discounts
                                    fetch('/get-discount/'+productId+'/'+quantity)
                                        .then(response=>response.json())
                                        .then(discountData =>{
                                            var discount = parseFloat(discountData.discount) || 0;
                                            console.log('discount:', discount);
                                            row.querySelector('.product_discount').value = discount;
                                            // calculate subtotal
                                            var subtotal = -row.querySelector('.product_amount').value * discount / 100 + amount;
                                            row.querySelector('.product_subtotal').value = subtotal.toFixed(2);
                                            console.log('subtotal:',subtotal);
                                            // Calculate net amount
                                            calculateNetAmount();
                                        })
                                    .catch(error=>{
                                        console.error('Error parsing product discouts', error);
                                    })
                                })
                    
                            .catch(error => {
                                console.error('Error fetching product information:', error);
                            });
                            
                            })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    
                });
 
                
            };
            // Attach quantity change event listener to existing rows
            document.querySelectorAll('.product_quantity').forEach(function(quantityInput) {
                handleQuantityChange(quantityInput);
            });
        </script>
    @endsection
