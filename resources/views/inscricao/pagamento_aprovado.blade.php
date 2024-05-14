@extends('layouts.rikassa')
@section('title', 'Confirmacao do Email')
@section('content')

<x-menu />

<style>
    p, a, h3 {
        font-size: 16px;
        color: #94580A;
    }
</style>
    <div class="mt-3">

        <h3 class="mt-5 mb-5">Parabéns, {{ $dados['nome'] }}!</h3>
        <p>Seu pagamento foi <strong>aprovado</strong> pelo banco.</p>
        <p>Aguarde! Enviaremos uma mensagem para o endereço <strong>{{ $dados['email']}}</strong> que você cadastrou, com a confirmação da sua inscrição.</p>
        <p>Se precisar, poderá entrar em contato conosco acessando o menu Contato na pagina principal de nosso site.</p>
        <br>
        <p>Até lá!</p>
    </div>

{{-- @push('scripts')
@endpush --}}
@endsection