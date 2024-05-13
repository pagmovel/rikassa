@extends('layouts.rikassa')
@section('title', 'Confirmacao do Email')
@section('content')

<x-menu />

<style>
    p, a, h3, pre {
        font-size: 16px;
        color: #94580A;
    }
</style>
    <div class="mt-3">

        <h3 class="mt-5 mb-5">Parabéns, você validou o comprovante de pagamento via pix feito por {{ $dados['nome'] }}</h3>
        <br>
        <p><strong>Dados do participante:</strong></p>
        <pre>
Nome:                            <strong>{{ $dados['nome'] }}</strong>
Email:                           <strong>{{ $dados['email'] }}</strong>
Nº Whatsapp:                     <strong>{{ $dados['whatsapp'] }}</strong>
Data Nascimento:                 <strong>{{ $dados['nascimento'] }}</strong>
Altura:                          <strong>{{ $dados['altura'] }}</strong>
Cidade:                          <strong>{{ $dados['cidade'] }}</strong>
Estado:                          <strong>{{ $dados['estado'] }}</strong>
Bairro Onde Mora:                <strong>{{ $dados['bairro'] }}</strong>
Profissão:                       <strong>{{ $dados['profissao'] }}</strong>
Idiomas Falados:                 <strong>{{ $dados['idiomas'] }}</strong>
Nacionalidade:                   <strong>{{ $dados['nacionalidade'] }}</strong>
Intereses Pessoais:              <strong>{{ $dados['interesses_pessoais'] }}</strong>
Experiência Prévia em Concursos: <strong>{{ $dados['experiencia_previa'] }}</strong>
Instagram:                       <strong>{{ $dados['instagram'] }}</strong>
Facebook:                        <strong>{{ $dados['facebook'] }}</strong>
X (twitter):                     <strong>{{ $dados['x_twitter'] }}</strong>
</pre>
        <p>
            <strong>*** Pagamento Confirmado! ***</strong>
        </p>
        <br>
        <p>A imagem doparticipante foi enviada por email com o título: <strong>[Nova Inscrição Rikassa] {{ $dados['nome'] }}</strong>, enviado em {{ \Carbon\Carbon::parse($dados['confirmou_email'])->format('d/m/Y') }}.
        </p>
        
    </div>

{{-- @push('scripts')
@endpush --}}
@endsection