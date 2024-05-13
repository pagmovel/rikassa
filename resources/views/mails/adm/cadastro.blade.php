@extends('layouts.rikassa')
@section('title', 'Nova Inscrição')
@section('content')

<x-logo />
<br><br>
<h2>Olá Administrador! Temos uma nova inscrição do concurso RIKASSA</h2>
<br>
<pre>
Nome: <strong>{{ $dados['nome'] }}</strong>
Email: <strong>{{ $dados['email'] }}</strong>
Nº Whatsapp: <strong>{{ $dados['whatsapp'] }}</strong>
Data Nascimento: <strong>{{ $dados['nascimento'] }}</strong>
Altura: <strong>{{ $dados['altura'] }}</strong>
Cidade: <strong>{{ $dados['cidade'] }}</strong>
Estado: <strong>{{ $dados['estado'] }}</strong>
Bairro Onde Mora: <strong>{{ $dados['bairro'] }}</strong>
Profissão: <strong>{{ $dados['profissao'] }}</strong>
Idiomas Falados: <strong>{{ $dados['idiomas'] }}</strong>
Nacionalidade:  <strong>{{ $dados['nacionalidade'] }}</strong>
Intereses Pessoais: <strong>{{ $dados['interesses_pessoais'] }}</strong>
Experiência Prévia em Concursos: <strong>{{ $dados['experiencia_previa'] }}</strong>
Instagram: <strong>{{ $dados['instagram'] }}</strong>
Facebook: <strong>{{ $dados['facebook'] }}</strong>
X (twitter): <strong>{{ $dados['x_twitter'] }}</strong>
</pre>
<p>
    <strong>*** Aguardando pagamento! ***</strong>
</p>


@endsection
<div>
    <!-- resources/views/mails/enviar_inscricao.blade.php -->
{{-- <a href=""> <img src="{{ env('APP_LOGO') }}" width="250" alt="logo"> </a> --}}


</div>
