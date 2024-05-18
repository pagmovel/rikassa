<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;

class AdmEventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        // ddd('teste');
        if ($request->ajax()) {
            $data = Eventos::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" onclick="alert('.$row->id.')"
                    class="edit btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a> 
                    <a href="javascript:void(0)" 
                    class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->editColumn('url', function ($row) {
                    return '<a href="'.$row->url.'" target="_blank">'.$row->url.'</a>';
                })
                ->rawColumns(['action', 'url'])
                ->make(true);
        }

        // Se não tiver autenticado
        if (!Auth::check()){
            // Verifica se veio pela url assinada validando
            if (! $request->hasValidSignature()) {
                abort(401);
            }
            // Se veio pela url assinada, logue na conta admin
            // Faz o login do usuário confirmado
            $user = User::where('id',  1)->first();
            Auth::login($user);

            $eventos = Eventos::orderby('start')->get();
            // dd('aqui')
            // return view('adm.calendario.listar', compact('user','eventos'));
            return view('adm.calendario.listar', compact('user','eventos'));
        }
    }

    public function listar(Request $request){
        // $url_confirmacao = URL::signedRoute('adm.calendario.listar', ['ni' => 9102837465]);
        // echo $url_confirmacao;
        // http://rikassa.test/adm/calendario?ni=9102837465&signature=94b37a5ace7c748c677fc5a3e80d7b820520532edfbf8662c91a1c10d8902069
        
        // Se não tiver autenticado
        if (!Auth::check()){
            // Verifica se veio pela url assinada validando
            if (! $request->hasValidSignature()) {
                abort(401);
            }
            // Se veio pela url assinada, logue na conta admin
            // Faz o login do usuário confirmado
            $user = User::where('id',  1)->first();
            Auth::login($user);

            $eventos = Eventos::orderby('start')->get();
            // dd('aqui')
            return view('adm.calendario.listar', compact('user','eventos'));

        } 

        

        
        
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
