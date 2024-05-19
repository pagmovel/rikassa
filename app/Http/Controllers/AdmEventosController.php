<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Eventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;

class AdmEventosController extends Controller
{
    private $signature;
    private $ni;

    public function __construct()
    {
        $this->signature = env('SIGNATURE');
        $this->ni = env('NI');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Eventos::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-regular fa-pen-to-square"></i></a>';
                    $btnDelete = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></a>';
                    
                    return $btnEdit . ' ' . $btnDelete;
                })
                ->editColumn('url', function ($row) {
                    return '<a href="'.$row->url.'" class="url" target="_blank">'.$row->url.'</a>';
                })
                ->rawColumns(['action', 'url'])
                ->editColumn('start', function ($evento) {
                    return Carbon::parse($evento->start)->format('d/m/Y H:i \h\s.');
                })
                ->editColumn('end', function ($evento) {
                    return Carbon::parse($evento->end)->format('d/m/Y H:i \h\s.');
                })
                ->make(true);
        }

        // Tratamento de não autenticado com URL assinada
        if (!Auth::check()) {
            if (!$request->hasValidSignature()) {
                // dd($request->hasValidSignature());
                abort(403, 'Acesso não autorizado.');  // Alterado para 403 Forbidden
            }
            $user = User::where('id', 1)->firstOrFail();  // Usando firstOrFail para lidar com usuário não encontrado
            Auth::login($user);
        }

        return view('adm.calendario.listar', compact('user'));
    }


    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'start' => 'required|date_format:Y-m-d H:i',
            'end' => 'required|date_format:Y-m-d H:i',
            'url' => 'nullable|url',
        ]);
        // dd($request->all());

        // Verifica se o ID do evento está vazio para criação de um novo registro
        
        if (empty($request->input('id'))) {
            // CREATE
            $evento = new Eventos([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'url' => $request->input('url'),
            ]);
            $evento->save();
            return redirect()->route('adm.calendario.index', [
                'ni' => $this->ni,
                'signature' => $this->signature
            ])->with('success', 'Evento atualizado com sucesso!');
        } else {
            // UPDATE
            $evento = Eventos::findOrFail($request->input('id'));
            $evento->update($request->all());
            return redirect()->route('adm.calendario.index', [
                'ni' => $this->ni,
                'signature' => $this->signature
            ])->with('success', 'Evento atualizado com sucesso!');
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        
        try {
            $evento = Eventos::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $evento,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Evento não encontrado.',
            ], 404);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $evento = Eventos::findOrFail($request->id);
            $evento->delete();
    
            return redirect()->route('adm.calendario.index', [
                'ni' => $this->ni,
                'signature' => $this->signature
            ])->with('success', 'Evento deletado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('adm.calendario.index', [
                'ni' => $this->ni,
                'signature' => $this->signature
            ])->with('error', 'Erro ao deletar evento.');
        }
    }
}
