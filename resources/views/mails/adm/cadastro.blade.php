@extends('layouts.rikassa')
@section('title', 'Nova Inscrição')
@section('content')

<x-logo />
<br><br>
@if (isset($negado))
    <h2>Prezado Administrador!<br>Temos uma inscrição do concurso Miss Rikassa D'Lux com Pagamento Não Autorizado.</h2>
@elseif ($status == 'PAGAMENTO APROVADO')
    <h2>Prezado Administrador!<br>A seguinte inscrição do concurso Miss Rikassa D'Lux teve o Pagamento Aprovado.</h2>
@else
    <h2>Prezado Administrador!<br>Temos uma nova inscrição do concurso Miss Rikassa D'Lux.</h2>
@endif
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
    <strong style="color: red">*** {{ $status }}! ***</strong>
</p>


@endsection
<div>
    <!-- resources/views/mails/enviar_inscricao.blade.php -->
{{-- <a href=""> <img src="{{ env('APP_LOGO') }}" width="250" alt="logo"> </a> --}}


</div>
