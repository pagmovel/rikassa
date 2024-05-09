<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\Contact;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\True_;

class InscricaoController extends Controller
{
    public function __construct(
        private MercadoPagoService $mercadoPagoService
    ){}

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


        if($resultado){
            //Email solicitando confirmação (para checar se o email existe)
            $sent = Mail::to($request->input('email'), $request->input('nome'))->send(new Contact([
                'fromName' => env('MAIL_NAME_RECEIVE'), //$request->input('name'),
                'fromEmail' => env('MAIL_ADDRESS_RECEIVE'), //$request->input('email'),
                'subject' => '[Inscrição Rikassa] '.$request->input('nome'),
                'message' => $resultado,
            ]));

            dd($resultado, $resultado->id,'email sent',$sent);
        } else {
            // return TblContratoAux::where('localizador_npj', $request['localizador_npj'])->orderBy('id')->get();
            echo "Não conseguiu salvar";
        }


        // dd($request->input('email'));

    }



    public function confirmar($email){
        $dados = Inscricao::where('email', $email)->first();
        if ( is_null($dados->confirmou_email) ){
            // Confirma o email
            $dados = Inscricao::where('email', $email)->update(['confirmou_email' => date('Y-m-d H:i:s')]);

        } else {
            // email já estava confirmado
            $dataHoraAmericana = $dados->confirmou_email;
            $hora_ja_confirmada = Carbon::createFromFormat('Y-m-d H:i:s', $dataHoraAmericana)->format('d/m/Y H:i:s');
        }

        // Renderizar a tela para o pagamento

        // Exibir para a pessoa os próximos passos (enviar fotos e vídeos pelo zap)
    }




    public function finalizarCompra()
    {
        //
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
