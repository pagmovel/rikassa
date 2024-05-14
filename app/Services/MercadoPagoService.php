<?php

namespace App\Services;

use App\Models\Inscricao;
use App\Models\Pagamento;
use MercadoPago\SDK;
use MercadoPago\Item;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Resources\Preference;
use MercadoPago\Client\Preference\PreferenceClient;

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


    public function obterPago()
    {
        //
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

        // Registra o pagamento no banco de dados
        return Pagamento::create($filteredArray);

        // return 
        // dd(Auth::user(), $res, $filteredArray);
    }
}
