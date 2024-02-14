<!-- resources/views/customers/edit.blade.php -->
@section('scripts')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<h1>Edit Product</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="{{$product->name}}" required>
    </div>

    <div class="form-group">
        <label for="price">price</label>
        <input type="text" name="price" id="price" class="form-control" placeholder="{{$product->price}}" required>
    </div>

    <div class="form-group">
        <label for="expiry_date">Expiry Date</label>
        <input type="text" name="expiry_date" id="expiry_date" class="form-control" placeholder="{{$product->expiry_date}}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
<script>
    $(document).ready(function(){
        $('#expiry_date').datepicker({
            format: 'yyyy-mm-dd', // Date format
            autoclose: true // Close the Datepicker when a date is selected
        });
    });
</script>

<a href="{{ route('products.index') }}" class="btn btn-primary">Back to all Products</a>