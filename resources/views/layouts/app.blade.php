<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include select2 library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        @yield('content')
        @yield('scripts')
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Custom scripts -->
    <script>
        $(document).ready(function() {
            document.getElementById('bulk-generate').addEventListener('click', () => {
                console.log('button clicked');
                var csrfToken = "{{ csrf_token() }}"; 
                $.ajax({
                    url:'/orders/bulk',
                    type:'POST',
                    data: JSON.stringify({
                        'ids': ids,
                        '_token': csrfToken
                    }),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                });
            });
        });
    </script>
</body>
</html>
