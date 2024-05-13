<?php

namespace App\Services;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

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

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config(mercadopago.access_token));
    }

    public function criarPreferencia()
    {
        $client = new PreferenceClient();
        $preference = $client->create([
            "items"=> array(
                array(
                "title" => "Inscrição Concurso RIKASSA 2024",
                "quantity" => 1,
                "unit_price" => 1500.00
                )
            )
        ]);
    }


    public function obterPago()
    {
        //
    }
}
