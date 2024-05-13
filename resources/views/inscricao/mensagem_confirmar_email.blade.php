@extends('layouts.rikassa')
@section('title', 'Confirmacao do Email')
@section('content')

<x-menu />

<style>
    p, a {
        font-size: 16px;
        color: #94580A;
    }
</style>
    <div class="mt-3">



        <h3 class="mb-4">Olá, {{ $resultado->nome }}</h3>
        <p>Agradecemos pela sua inscrição.</p>
        <p>Enviamos um email para o endereço {{ $resultado->email}} que você cadastrou.</p>
        <p>Agora você precisa acessar seu email e seguir as orientações dele para confirmar sua inscrição.</p>
        <p>Isto é necessário para que possamos te informar as formas de pagamento.</p>
        <p>Aguardamos por sua confirmação!</p>
        <p>Até lá!</p>
    </div>

{{-- @push('scripts')
@endpush --}}
@endsection