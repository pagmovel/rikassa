@extends('layouts.rikassa')
@section('title', 'Nova Inscrição')
@section('content')

<x-logo />
<br><br>
<p>Caro Administrador! Por favor confira o comprovante de pagamento PIX em anexo e clique no link abaixo para validá-lo.</p>

<p>
    <strong><a href="{{ $url_confirmacao }}">*** Para confirmar o pagamento CLIQUE AQUI ***</a></strong>
</p>

<p>Caso haja algo errado, favor contactar o participante pelo canais abaixo:</p>
<br>
<pre>
Nome: <strong>{{ $dados['nome'] }}</strong>
Email: <strong>{{ $dados['email'] }}</strong>
---------------------------------------------------------------
Whatsapp: <strong>{{ $dados['whatsapp'] }}</strong>
Instagram: <strong>{{ $dados['instagram'] }}</strong>
Facebook: <strong>{{ $dados['facebook'] }}</strong>
X (twitter): <strong>{{ $dados['x_twitter'] }}</strong>
</pre>



@endsection

