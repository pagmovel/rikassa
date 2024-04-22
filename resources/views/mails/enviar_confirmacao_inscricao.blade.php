<!-- resources/views/mails/enviar_inscricao.blade.php -->
<a href="{{ env('APP_URL')}}"> <img src="https://exatamentepublicidade.com.br/rikassa/wp-content/uploads/2024/04/LOGO-PRETA-300x125.png" width="250" alt="logo"> </a>
<h2>Olá, {{ $nome_reduzido }}</h2>
<p>Agradecemos pela sua inscrição.</p>
<p>Agora você precisa confirmar este email <a href="{{ env('APP_URL')}}/inscricao/confirmada/{{ $dados['email'] }}">clicando aqui.</a></p>
<p>Caso não consiga clicar no link acima, por favor copie o endereço abaixo e cole na barra de endereços do seu navegador.</p>
<p>http://rikassa.test/inscricao/confirmada/{{ $dados['email'] }}</p>
<br><br>
<p>{{ env('APP_URL')}}</p>