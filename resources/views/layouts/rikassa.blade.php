<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rikassa - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">


    @if (env('APP_ENV')=='local')
        <?php $caminho = ''; ?>
    @else
        <?php $caminho = '/public/'; ?>
    @endif

    <link rel="stylesheet" href="{{ asset($caminho.'css/custom.css')}} ">


<style>
    .form-control {
        border: 1px solid #94580A !important;
    }
    input, label, .texto {
        color: #94580A !important;
    }

    .form-check-input:checked {
        background-color: #94580A !important;
        border-color: #563101 !important;
    }
    
    .erro-estado {
        width: 100%;
        margin-top: 0.25rem;
        font-size: .875em;
        color: #dc3545;
    }

</style>

</head>
<body class="container mt-1">

    @yield('content')

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @stack('scripts')
    
</body>
</html>
