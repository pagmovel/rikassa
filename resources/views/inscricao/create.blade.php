<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rikassa - Formulário de3 Inscrição</title>
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
    input, label {
        color: #94580A !important;
    }
    
</style>

</head>
<body class="container">
    <div>
        <div class="row">
            <h2 class="text-center titulo">Formulário de Inscrição</h2>
        </div>
    
        <form class="form-floating" action="{{ route('inscricao.store') }}" method="post">
            @csrf
            {{-- <input type="text" name="teste2" value="teste2">
            <input type="text" name="teste3" value="teste3"> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3 form-floating">
                        <input type="text" name="name" class="form-control" id="floatingInput1" placeholder="Name"  value="Marcos Ronaldo Almeida Silva">
                        <label for="floatingInput1">Seu Nome</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 form-floating">
                        <input type="email" name="email" class="form-control" id="floatingInput2" placeholder="email@domimnio.com" value="marcos.ronaldo@gmail.com">
                        <label for="floatingInput2">Seu email</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="senha" value="WWWWWW">
                        <label for="floatingPassword">Sua Senha</label>
                    </div>
                </div>

                <div class="col-auto">
                    <button type="submit" class="mb-3 btn btn-primary">Enviar Inscrição</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
</body>
</html>