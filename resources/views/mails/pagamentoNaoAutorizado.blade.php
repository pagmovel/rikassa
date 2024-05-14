<!-- resources/views/mails/enviar_inscricao.blade.php -->
{{-- <a href=""> <img src="{{ env('APP_LOGO') }}" width="250" alt="logo"> </a> --}}
<x-logo />
<br><br>

<p>Prezada {{ $dados['nome'] }},<br>
    Infelizmente o seu pagamento não foi autorizado pelo Mercado Pago.<br><br>
<a href="{{ $url }}">Clique aqui para tentar novamente com um novo cartão.</a><br>
<br><br>Atenciosamente,</p>
<p><br>Equipe Rikassa.</p>