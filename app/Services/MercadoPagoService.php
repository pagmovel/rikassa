<?php

namespace App\Services;

use MercadoPago\SDK;
use MercadoPago\Item;
use App\Models\Inscricao;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Mail\DadosCadastrais;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Resources\Preference;
use App\Mail\EmailPagamentoNaoAutorizado;
use App\Http\Controllers\InscricaoController;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Mail\EnviarEmailAoParticipanteConfirmandoPagamento;

class MercadoPagoService {
    /**Public Key
        TEST-32454f39-3d04-4484-96fa-5ff9402f5cd6

        Access Token
        TEST-911204885275469-050712-d23bd2267f9339817cb8dab791e08676-736474578

        viklan2b@gmail.com

        https://www.youtube.com/watch?v=HPdOyvqKAzc&ab_channel=RodrigoR%C3%ADo

        https://www.mercadopago.com.br/developers/pt/reference
        https://www.mercadopago.com.br/developers/pt/docs/checkout-pro/integrate-preferences
        https://www.mercadopago.com.br/developers/pt/docs/checkout-pro/integrate-checkout-pro/web
        https://www.mercadopago.com.br/developers/pt/live-demo/checkout-pro
        https://www.mercadopago.com.br/developers/pt/docs/checkout-pro/integration-test/test-accounts
        https://www.mercadopago.com.br/developers/panel/app/create-app
        https://www.mercadopago.com.br/developers/pt/reference/preferences/_checkout_preferences/post

    */

    /*
     * Public Key
     * TEST-2f7671c1-ec6e-4ff6-af9a-f760699020f2
     *
     * Access Token
     * TEST-6429758410265883-051009-63275dad8555974c08babdb43ab202fb-238034526
     *
     *
     */

    public $inscricao;

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
        // $this->inscricao = Inscricao::where("email", Auth::user()->email)->first();
    }

    public function criarPreferencia($id)
    {
        
        $client = new PreferenceClient();
        $preference = $client->create([
            "items"=> array(
                array(
                "title" => "Inscrição Concurso RIKASSA 2024",
                "quantity" => 1,
                "unit_price" => 1500.00,
                )
            ),
            "back_urls" => array( //"http://localhost/rikassa/public/inscricao",
                "success" => env('APP_URL') . "/mercadopago/webhook/success",
                "failure" => env('APP_URL') . "/mercadopago/webhook/failure",
                "pending" => env('APP_URL') . "/mercadopago/webhook/pending",
            ),
            "auto_return" => "approved",
            "external_reference" => $id,
           
        ]);

        // $preference->external_reference = $id;

        // $preference

        // dd($preference);

       
        return $preference->sandbox_init_point;

//        $client->back_urls = array(
//            "success" => "https://www.seu-site/success",
//            "failure" => "http://www.seu-site/failure",
//            "pending" => "http://www.seu-site/pending"
//        );
//        $client->auto_return = "approved";
    }


    public function VerificarStatusPagamento($payment_id) // do mpwebrook
    { // https://www.youtube.com/watch?app=desktop&v=HCbk9vc4Wt0&ab_channel=LuanAlves

        $client = new PaymentClient();

        $payment = $client->get($payment_id);

        if (isset($payment->id)){            
            $inscricao = Inscricao::where("id", $payment->external_reference)->first();

            // APROVADO
            if ( $inscricao !== Null && $payment->status == 'approved'){
                
                // Atualiza a inscricao
                $inscricao->update(['pagou' => True, 'cartao' => 'SIM' ]);
                
                // envia email com o cadastro para administrador Rikassa
                $sent = Mail::to( env('MAIL_ADDRESS_RECEIVE'), env('MAIL_NAME_RECEIVE') )->send(new DadosCadastrais([
                    'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                    'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                    'subject' => "[Nova Inscrição Concurso Miss Rikassa D'Lux] ".$inscricao['nome'] ,
                    'message' => $inscricao,
                    'status' => 'PAGAMENTO APROVADO'
                ]));

                
                // Enviar email ao participante com a aprovação do pagamento e confirmação da inscrição no concurso
                $sent = Mail::to( $inscricao['email'], $inscricao['nome'] )->send(new EnviarEmailAoParticipanteConfirmandoPagamento([
                    'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                    'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                    'subject' => "[Concurso Miss Rikassa D'Lux] CONFIRMAÇÃO DE PAGAMENTO",
                    'message' => $inscricao,
                ]));

            } else if ( $inscricao !== Null && $payment->status == 'rejected'){
                // envia email para administrado informando que o pagamento foi rejeitado 

                // envia email com o cadastro para administrador Rikassa
                $sent = Mail::to( env('MAIL_ADDRESS_RECEIVE'), env('MAIL_NAME_RECEIVE') )->send(new DadosCadastrais([
                    'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                    'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                    'subject' => "[Nova Inscrição Concurso Miss Rikassa D'Lux] ".$inscricao['nome'] ,
                    'message' => $inscricao,
                    'status' => 'PAGAMENTO NÃO AUTORIZADO',
                    'negado' => True,
                ]));

                // enviar email ao participante informando que o pagamento foi recusado
                $url_confirmacao = URL::signedRoute('inscricao.pagamento', ['ni' => $inscricao->id]);
                $sent = Mail::to($inscricao['email'], $inscricao['nome'])->send(new EmailPagamentoNaoAutorizado([
                    'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                    'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                    'subject' => "[Inscrição Concurso Miss Rikassa D'Lux] ".$inscricao['nome'],
                    'message' => $inscricao,
                    'url' => $url_confirmacao,
                ]));

            }
        }
    }


    public function webhookMercadoPago(Request $request)
    {

        Log::debug($request->input());
        $dados = $request->input();

        $filteredArray = array_filter($dados, function ($value) {
            if ($value != 'null'){
                return $value;
            }
        });

        return Pagamento::create($filteredArray);

        if (isset($filteredArray['collection_id'])) {
            // Registra o pagamento no banco de dados
            return Pagamento::create($filteredArray);
        } else {
            return false;
        }

        // return 
        // dd(Auth::user(), $res, $filteredArray);
    }
}
