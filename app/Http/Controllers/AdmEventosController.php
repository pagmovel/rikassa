<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
{ // http://rikassa.test/adm/calendario?ni=9102837465&signature=94b37a5ace7c748c677fc5a3e80d7b820520532edfbf8662c91a1c10d8902069
    if ($request->ajax()) {
        $data = Eventos::all();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btnEdit = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-regular fa-pen-to-square"></i></a>';
                $btnDelete = '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $btnEdit . ' ' . $btnDelete;
            })
            ->editColumn('url', function ($row) {
                return '<a href="'.$row->url.'" target="_blank">'.$row->url.'</a>';
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
            abort(403, 'Acesso não autorizado.');  // Alterado para 403 Forbidden
        }
        $user = User::where('id', 1)->firstOrFail();  // Usando firstOrFail para lidar com usuário não encontrado
        Auth::login($user);
    }

    // $eventos = Eventos::orderBy('start')->get();
    return view('adm.calendario.listar', compact('user'));
    // return view('adm.calendario.listar', compact('eventos'));
    
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
        dd($request->all());
        $request->validate([
            'start' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i',
            // outros campos conforme necessário
        ]);

        
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evento = Eventos::findOrFail($id);
        $evento->update($request->all());
        return response()->json(['success' => 'Evento atualizado com sucesso']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}