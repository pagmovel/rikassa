<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InscricaoController extends Controller
{
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input('email'));
        //Email solicitando confirmação (para checar se o email existe)
        $sent = Mail::to($request->input('email'), $request->input('name'))->send(new Contact([
            'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
            'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
            'subject' => '[Inscrição Rikassa] '.$request->input('name'),
            'message' => $request->all(),
        ]));

        dd('email sent',$sent);
    }



    public function confirmar($email){
        dd($email);
        // Criar pagina para avisdar sobre a confirmação checada no banco de dados.
        // Enviar email com a confirmação para o cliente e a rikassa
        // Exibir para a pessoa os próximos passos (pagar, enviar fotos e vídeos pelo zap)
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
