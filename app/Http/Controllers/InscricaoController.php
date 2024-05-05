<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InscricaoController extends Controller
{
    
    protected function rules($request)
    {
        $rules =  [
            'nome' => 'required',
            'email' => 'required|email|unique:inscricao,email', // Adicionando a regra unique para o campo email na tabela inscricao
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->rules($request);

        $request['altura'] = str_replace(",", ".", $request['altura']);

        $filePath = $request->file('foto')->store('storage/app/fotos');
        $fileName = basename($filePath);
        $campos = $request->except(['foto','_token']);

        $campos['foto'] = $fileName;
        // dd($campos);

        $resultado = Inscricao::create($campos);
        
        dd($resultado, $resultado->id);
        // if(!$resultado){
        //     return ['errs' => 'Não foi possível atualizar este contrato.'];
        // } else {
        //     return TblContratoAux::where('localizador_npj', $request['localizador_npj'])->orderBy('id')->get();
        // }


        // dd($request->input('email'));
        //Email solicitando confirmação (para checar se o email existe)
        // $sent = Mail::to($request->input('email'), $request->input('name'))->send(new Contact([
        //     'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
        //     'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
        //     'subject' => '[Inscrição Rikassa] '.$request->input('name'),
        //     'message' => $request->all(),
        // ]));

        // dd('email sent',$sent);
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
        // CONFIRMAÇÃO DE PAGAMENTO

        // Prezada [Nome da Participante], estamos entusiasmados em confirmar que seu pagamento para o Concurso de Beleza foi recebido com sucesso. Como parte do nosso processo de comunicação contínua e para mantê-la informada sobre cada passo do concurso, você será adicionada a um grupo exclusivo de WhatsApp. Enviamos o link de acesso ao grupo para o e-mail cadastrado. Agradecemos por escolher participar do nosso concurso e estamos ansiosos para vê-la brilhar. Atenciosamente, Equipe Rikassa.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
