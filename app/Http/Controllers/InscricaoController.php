<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\Contact;
use App\Models\Inscricao;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Mail\DadosCadastrais;
use App\Mail\EnviarComprovanteAdm;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\EmailPagamentoNaoAutorizado;
use phpDocumentor\Reflection\PseudoTypes\True_;
use App\Mail\EnviarEmailAoParticipanteConfirmandoPagamento;

class InscricaoController extends Controller
{
    public function __construct(
        private MercadoPagoService $mercadoPagoService
    ){}

    protected function rules_pix($request)
    {
        $rules =  [
            'comprovante' => [
                'required',
                'image',
                'mimes:jpg,png',
                // 'dimensions:ratio=3/2',
            ]
        ];

        return $request->validate($rules);
    }
    protected function rules($request)
    {
        $rules =  [
            'nome' => 'required',
            // 'email' => 'required|email|unique:inscricao,email', // Adicionando a regra unique para o campo email na tabela inscricao
            'whatsapp' => 'required',
            'nascimento' => 'required',
            'altura' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'bairro' => 'required',
            'profissao' => 'required',
            'idiomas' => 'required',
            'nacionalidade' => 'required',
            'interesses_pessoais' => 'required',
            'experiencia_previa' => 'required',
            'concordo' => 'required',

            'foto' => [
                'required',
                'image',
                'mimes:jpg,png',
                // 'dimensions:ratio=3/2',
            ]
        ];

        return $request->validate($rules);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inscricao.create');
    }

    /**
     * Store data customer
     */
    public function store(Request $request)
    {
        $this->rules($request);

        $request['altura'] = str_replace(",", ".", $request['altura']);

        $filePath = $request->file('foto')->store('fotos');
        $fileName = basename($filePath);
        $campos = $request->except(['foto','_token']);

        $campos['foto'] = $fileName;
        // dd($campos);

        $resultado = Inscricao::create($campos);

        // Gera url para confirmação
        $url_confirmacao = URL::signedRoute('inscricao.confirmar', ['ni' => $resultado->id]);

        if($resultado){
            //Email solicitando confirmação (para checar se o email existe)
            $sent = Mail::to($request->input('email'), $request->input('nome'))->send(new Contact([
                'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                'subject' => "[Inscrição Concurso Miss Rikassa D'Lux] ".$request->input('nome'),
                'message' => $resultado,
                'url' => $url_confirmacao,
            ]));

            if($sent){
                // Enviar o cadastro pro ADM Rikassa
                $sent = Mail::to( env('MAIL_ADDRESS_RECEIVE'), env('MAIL_NAME_RECEIVE') )->send(new DadosCadastrais([
                    'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                    'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                    'subject' => "[Nova Inscrição Concurso Miss Rikassa D'Lux] ".$request->input('nome'),
                    'message' => $resultado,
                ]));

                // APAGAR ARQUIVO DA FOTO
                if($sent){
                    try {
                        $fotoPath = 'fotos'.DIRECTORY_SEPARATOR . $campos['foto'];
                        // $normalizedPath = str_replace('/', DIRECTORY_SEPARATOR, $fotoPath);
                        $filePath = storage_path($fotoPath);

                        Log::error("Vamos apagar arquivo - ".$filePath);
                        Storage::delete($fotoPath);
                        if (Storage::exists($fotoPath)) {
                            Storage::delete($fotoPath);
                            Log::error("Passou pelo apagar arquivo");
                        }

                    } catch (\Exception $e) {
                        // Log error or handle exception
                        Log::error("Erro ao excluir arquivo: {$e->getMessage()}");
                    }
                    
                }

                return view('inscricao.mensagem_confirmar_email', compact('resultado'));
                // dd($resultado, $resultado->id,'email sent',$sent);
            } else {
                echo "Houve um erro ao tentar enviar o email de confirmação para seu email.";
            }
            // return view('inscricao.mensagem_confirmar_email', compact('resultado'));
        } else {
            // return TblContratoAux::where('localizador_npj', $request['localizador_npj'])->orderBy('id')->get();
            echo "Não conseguiu salvar";
        }


        // dd($request->input('email'));

    }


    public function confirmar(Request $request, $id){

        // Valida a url
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $dados = Inscricao::where('id', $id)->first();

        $dataHoraAmericana = Null;
        $hora_ja_confirmada = Null;

        if ($dados) {
            if ( is_null($dados->confirmou_email) ){
                // Confirma o email
                Inscricao::where('email', $dados['email'])->update(['confirmou_email' => date('Y-m-d H:i:s')]);
                
                // Cadastro na tabela de usuarios
                $user['name'] = $dados->nome;
                $user['email'] = $dados->email;
                $user['password'] = Hash::make($dados->email);
                $user = User::create( $user );


                //

            } else {
                // email já estava confirmado
                $dataHoraAmericana = $dados->confirmou_email;
                $hora_ja_confirmada = Carbon::createFromFormat('Y-m-d H:i:s', $dataHoraAmericana)->format('d/m/Y H:i:s');

                // Faz o login do novo usuário
                $user = User::where('email', $dados->email)->first();
            }

            // Faz o login do usuário confirmado
            Auth::login($user);

            // Renderizar a tela para o pagamento
            $link_pagamento = $this->mercadoPagoService->criarPreferencia($id);

            return view('inscricao.confirmacao', compact('link_pagamento','user','dados','dataHoraAmericana','hora_ja_confirmada'));

        } else {

            echo 'Você ainda não completou sua inscrição no concurso!';

        }
        // Exibir para a pessoa os próximos passos (enviar fotos e vídeos pelo zap)
    }


    public function store_pix(Request $request)
    {
        if (Auth::check()) {
            $this->rules_pix($request);

            $filePath = $request->file('comprovante')->store('comprovantes');
            $fileName = basename($filePath);
            $campos = $request->except(['comprovante','_token']);

            $campos['comprovante_pix'] = $fileName;
            // $campos['pagou'] = True;

            // - atualizar registro da inscrição com comprovante = true
            $res = Inscricao::where('email', Auth::user()->email)->update($campos);

            // - enviar email para rikassa com o comprovante de pagamento junto com os dados da inscrição
            $inscricao = Inscricao::where('email', Auth::user()->email)->first();
            
            // Gera url para confirmação
            $url_confirmacao = URL::signedRoute('inscricao.confirmar_pix', ['ni' => $inscricao->id]);

            if($res){
                // Enviar o comprovante PIX para o ADM Rikassa
                $sent = Mail::to( env('MAIL_ADDRESS_RECEIVE'), env('MAIL_NAME_RECEIVE') )->send(new EnviarComprovanteAdm([
                    'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                    'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                    'subject' => "[PIX Inscrição Concurso Miss Rikassa D'Lux] ".$inscricao->nome,
                    'message' => $inscricao,
                    'url_confirmacao' => $url_confirmacao,
                ]));

                // APAGAR ARQUIVO DA FOTO
                if($sent){
                    try {
                        $fotoPath = 'fotos'.DIRECTORY_SEPARATOR . $campos['comprovante'];
                        // $normalizedPath = str_replace('/', DIRECTORY_SEPARATOR, $fotoPath);
                        $filePath = storage_path($fotoPath);

                        Log::error("Vamos apagar arquivo - ".$filePath);
                        Storage::delete($fotoPath);
                        if (Storage::exists($fotoPath)) {
                            Storage::delete($fotoPath);
                            Log::error("Passou pelo apagar arquivo");
                        }

                    } catch (\Exception $e) {
                        // Log error or handle exception
                        Log::error("Erro ao excluir arquivo: {$e->getMessage()}");
                    }
                }
    
                // dd($resultado, $resultado->id,'email sent',$sent);
    
                return view('inscricao.finalizacao_pix', compact('inscricao'));
            // - apagar arquivo da pasta
            }
            
            echo "Houve um erro ao salvar o comprovante. Por favor, tente novamente ou contate com o suporte";
            
        } else {
            abort(401);
        }
    }


    public function confirmar_pix(Request $request, $id){

        // Valida a url
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $dados = Inscricao::where('id', $id)->first();

        $dataHoraAmericana = Null;
        $hora_ja_confirmada = Null;

        if ($dados) {            
            // Validar o pagamento via PIX
            Inscricao::where('email', $dados['email'])->update(['pagou' => true]);

            // Enviar email ao participante informando que sua inscrição foi completada
            $this->EnviarEmailConfirmandoInscricaoAposPagamento($dados);

            // Exibir tela ao administrador com todos os dados do participante
            return view('inscricao.adm.validacao_pix', compact('dados'));

        } 

        echo "[InscricaoController: ".__LINE__.", ". $id .", ". $dados['email'] ." ] Erro! Contate o suporte!";
        // Exibir para a pessoa os próximos passos (enviar fotos e vídeos pelo zap)
    }



    public function EnviarEmailConfirmandoInscricaoAposPagamento($dados) 
    {
        // Enviar email ap participante com a aprovação do pagamento e confirmação da inscrição no concurso
        $sent = Mail::to( $dados['email'], $dados['nome'] )->send(new EnviarEmailAoParticipanteConfirmandoPagamento([
            'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
            'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
            'subject' => "[Concurso Miss Rikassa D'Lux] CONFIRMAÇÃO DE PAGAMENTO",
            'message' => $dados,
        ]));
        return;
    }



    
    // Abrir tela do Mercado Pago quando o pagamento for negado.
    // Link de aceeso vindo do email 
    public function pagamento(Request $request, $id){

        // Valida a url
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $dados = Inscricao::where('id', $id)->first();

        if ($dados) {
            // Faz o login do novo usuário
            $user = User::where('email', $dados->email)->first();

            // Faz o login do usuário confirmado
            Auth::login($user);

            // Renderizar a tela para o pagamento
            $link_pagamento = $this->mercadoPagoService->criarPreferencia($dados['id']);

            return view('inscricao.pagamento', compact('link_pagamento','user','dados'));

        } else {

            echo 'Você ainda não completou sua inscrição no concurso!';

        }
        // Exibir para a pessoa os próximos passos (enviar fotos e vídeos pelo zap)
    }



    // Este webrook trata os pagamentos em tela, executados pelo cliente
    public function webhook(Request $request) 
    {
        $pagto = $this->mercadoPagoService->webhookMercadoPago($request);

        $dados = Inscricao::where('id', $pagto['external_reference'])->first();

        if ($pagto->collection_status == 'approved'){

            // Enviar email de aprovação
            $this->EnviarEmailConfirmandoInscricaoAposPagamento($dados);

            // abrir pagina com mensagem de aprovação
            return view('inscricao.pagamento_aprovado', compact('dados'));

        } elseif ($pagto->collection_status == 'rejected'){
            // Gera url para confirmação
            $url_confirmacao = URL::signedRoute('inscricao.pagamento', ['ni' => $dados->id]);
            $status = 'COMPRA NEGADA';
            // enviar email informando que o pagamento foi recusado
            $sent = Mail::to($dados['email'], $dados['nome'])->send(new EmailPagamentoNaoAutorizado([
                'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                'subject' => "[Inscrição Concurso Miss Rikassa D'Lux] ".$dados['nome'],
                'message' => $dados,
                'url' => $url_confirmacao,
            ]));

            // Renderizar a tela para o pagamento
            $link_pagamento = $this->mercadoPagoService->criarPreferencia($dados['id']);

            // Abrir tela pagamento
            return view('inscricao.pagamento', compact('status','link_pagamento','dados'));

        } elseif ($pagto->collection_status == 'in_process'){  // aguardando autorização
            // Aguardando Confirmação do Pagamento
            return view('inscricao.pagamento_analise', compact('dados'));
        }
        
        // dd($pagto,$dados);
        /*

        Cartão              Número                  Código de segurança         Data de vencimento
        Mastercard          5031 4332 1540 6351     123                         11/25
        Visa                4235 6477 2802 5682     123                         11/25
        American Express    3753 651535 56885       1234                        11/25

        Status de pagamento	    Descrição	                                        Documento de identidade
        APRO	                Pagamento aprovado	                                (CPF) 12345678909
        OTHE	                Recusado por erro geral	                            (CPF) 12345678909
        CONT	                Pagamento pendente	                                -
        CALL	                Recusado com validação para autorizar	            -
        FUND	                Recusado por quantia insuficiente	                -
        SECU	                Recusado por código de segurança inválido	        -
        EXPI	                Recusado por problema com a data de vencimento	    -
        FORM	                Recusado por erro no formulário	
        */
    }

    

    public function mpwebhook(Request $request)
    {
        // Log::debug($request->input('data')['id']); return ;
        // return;
        $merchant_order_id = $request->input('data')['id'];
        // Log::debug("payment_id: ".$payment_id); return ;

        $pagamento = Pagamento::where('merchant_order_id', $merchant_order_id)->first();

        $inscricao = Inscricao::where('id', $pagamento->external_reference)->first();
        Log::debug($pagamento,$inscricao);

        if ($inscricao !== null){
            // Se encontrou a inscrição, envie email para o administrador e para o cliente
            Log::debug("Encontrou o cliente: ".$inscricao->nome, $request->input());
        }

        // dd($request);
        // Log::debug($request->input());
        // array (
    //     {
            // action: "payment.update",
            // api_version: "v1",
            // data: {"id":"86"},
            // date_created: "2021-11-01T02:02:02Z",
            // id: "123456",
            // live_mode: false,
            // type: "payment",
            // user_id: 94582170
    //      }
    //   )
    }


    public function mpwebhook2(Request $request)
    {
        
        Log::debug($request->input());

        $pagto = $this->mercadoPagoService->webhookMercadoPago($request);
        $dados = Inscricao::where('id', $pagto['external_reference'])->first();

        if ($pagto->collection_status == 'approved'){

            // Enviar email de aprovação
            $this->EnviarEmailConfirmandoInscricaoAposPagamento($dados);

        } elseif ($pagto->collection_status == 'rejected'){
            // Gera url para confirmação
            $url_confirmacao = URL::signedRoute('inscricao.pagamento', ['ni' => $dados->id]);
            $status = 'COMPRA NEGADA';
            // enviar email informando que o pagamento foi recusado
            $sent = Mail::to($dados['email'], $dados['nome'])->send(new EmailPagamentoNaoAutorizado([
                'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                'subject' => "[Inscrição Concurso Miss Rikassa D'Lux] ".$dados['nome'],
                'message' => $dados,
                'url' => $url_confirmacao,
            ]));

        } 

        // 

        // dd($pagto);
        /*
        Status de pagamento	Descrição	Documento de identidade
        APRO	Pagamento aprovado	(CPF) 12345678909
        OTHE	Recusado por erro geral	(CPF) 12345678909
        CONT	Pagamento pendente	-
        CALL	Recusado com validação para autorizar	-
        FUND	Recusado por quantia insuficiente	-
        SECU	Recusado por código de segurança inválido	-
        EXPI	Recusado por problema com a data de vencimento	-
        FORM	Recusado por erro no formulário	
        */
    }

    // public function webhook_success(Request $request)
    // {
    //     $this->mercadoPagoService->webhookMercadoPago($request);
    // }

    // public function webhook_failure(Request $request)
    // {
    //     $this->mercadoPagoService->webhookMercadoPago($request);
    // }

    // public function webhook_pending(Request $request)
    // {
    //     $this->mercadoPagoService->webhookMercadoPago($request);
    // }




    

// CONFIRMAÇÃO DE PAGAMENTO

        // Prezada [Nome da Participante], estamos entusiasmados em confirmar que seu pagamento para o Concurso de Beleza foi recebido com sucesso. Como parte do nosso processo de comunicação contínua e para mantê-la informada sobre cada passo do concurso, você será adicionada a um grupo exclusivo de WhatsApp. Enviamos o link de acesso ao grupo para o e-mail cadastrado. Agradecemos por escolher participar do nosso concurso e estamos ansiosos para vê-la brilhar. Atenciosamente, Equipe Rikassa.
    

}
