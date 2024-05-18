<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;


class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = Eventos::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title','content','color', 'start', 'end']);

            return response()->json($data);
        }

        return view('fullcalender');

        // return view('eventos.calendario', [
        //     'eventos' => $eventos,
        // ]);
    }


    public function list(Request $request)
    {
        $data = Eventos::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title','content','color', 'start', 'end']);

        return response()->json($data);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request): JsonResponse
    {

        switch ($request->type) {
            case 'add':
                $event = Eventos::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Eventos::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Eventos::find($request->id)->delete();

                return response()->json($event);
                break;
                
            default:
                # code...
                break;
        }
    }


    // public function listar(Request $request){
    //     // $url_confirmacao = URL::signedRoute('adm.calendario.listar', ['ni' => 9102837465]);
    //     // echo $url_confirmacao;
    //     // http://rikassa.test/adm/calendario?ni=9102837465&signature=94b37a5ace7c748c677fc5a3e80d7b820520532edfbf8662c91a1c10d8902069
        
    //     // Se não tiver autenticado
    //     if (!Auth::check()){
    //         // Verifica se veio pela url assinada validando
    //         if (! $request->hasValidSignature()) {
    //             abort(401);
    //         }
    //         // Se veio pela url assinada, logue na conta admin
    //         // Faz o login do usuário confirmado
    //         $user = User::where('id',  1)->first();
    //         Auth::login($user);

    //         $eventos = Eventos::orderby('start')->get();
    //         // dd('aqui')
    //         return view('adm.calendario.listar', compact('user','eventos'));

    //     } 

        

        
        
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }




    /**
     * Display the specified resource.
     */
    public function show(Eventos $eventos)
    {
        //
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eventos $eventos)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eventos $eventos)
    {
        //
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eventos $eventos)
    {
        //
    }
}
