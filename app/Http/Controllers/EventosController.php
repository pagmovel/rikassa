<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


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
