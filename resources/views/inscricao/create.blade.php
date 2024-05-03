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
    <div class="">
        <div class="row">
            <h2 class="mb-5 text-center titulo">Formulário de Inscrição</h2>
        </div>

        <div class="row g-3">

            <form class="mb-3 col-md-6 mx-auto form-floating" action="{{ route('inscricao.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <input type="text" name="teste2" value="teste2">
                <input type="text" name="teste3" value="teste3"> --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="name" class="form-control" id="floatingInput1" placeholder="Name"  value="Marcos Ronaldo Almeida Silva" required>
                            <label for="floatingInput1">Nome Completo</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="email" name="email" class="form-control" id="floatingInput2" placeholder="email@domimnio.com" value="marcos.ronaldo@gmail.com" required>
                            <label for="floatingInput2">Endereço de e-mail</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="whatsapp" class="form-control" id="floatingWhatsapp" placeholder="+55 71 99999-9999" value="" required>
                            <label for="floatingWhatsapp">Nº Whatsapp</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="date" name="data_nascimento" class="form-control" id="floatingDataNascimento" placeholder="+55 71 99999-9999" value="" required>
                            <label for="floatingDataNascimento">Data de Sascimento</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="number" name="altura" class="form-control" id="floatingAltura" placeholder="1,85" value="" required>
                            <label for="floatingAltura">Altura</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="cidade" class="form-control" id="floatingCidade" placeholder="Salvador" value="" required>
                            <label for="floatingCidade">Cidade</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            {{-- <input type="text" name="estado" class="form-control" id="floatingEstado" placeholder="Salvador" value="" required> --}}
                            <select name="estado" class="form-control" id="floatingEstado" placeholder="BA" required>
                                <option value=""></option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                <option value="EX">Estrangeiro</option>
                            </select>
                            <label for="floatingEstado">Estado</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="bairro" class="form-control" id="floatingBairro" placeholder="Pituba" value="" required>
                            <label for="floatingBairro">Bairro onde mora</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="file" name="foto" class="form-control" id="floatingFoto" placeholder="" value="" required>
                            <label for="floatingFoto">Foto recente</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="profissao" class="form-control" id="floatingProfissao" placeholder="Modelo" value="" required>
                            <label for="floatingProfissao">Profissão</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="idiomas" class="form-control" id="floatingIdiomas" placeholder="Português" value="" required>
                            <label for="floatingIdiomas">Idiomas falados</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="nacionalidade" class="form-control" id="floatingNacionalidade" placeholder="Brasileira" value="" required>
                            <label for="floatingNacionalidade">Nacionalidade</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="interesses_pessoais" class="form-control" id="floatingInteresses" placeholder="Viajar" value="" required>
                            <label for="floatingInteresses">Interesses pessoais</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="experiencia_previa" class="form-control" id="floatingExperienciaPrevia" placeholder="Nenhuma" value="" required>
                            <label for="floatingExperienciaPrevia">Experiência prévia em concursos</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="prefis_sociais" class="form-control" id="floatingPerfisSociais" placeholder="@rikassa" value="" required>
                            <label for="floatingPerfisSociais">Perfil de redes sociais</label>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="mb-3 btn btn-primary">Enviar Inscrição</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>















</body>
</html>
