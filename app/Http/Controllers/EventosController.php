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
                    ->whereDate('end', '<=', $request->end)
                    ->get(['id', 'title', 'content', 'color', 'start', 'end', 'url']);

            // Mapear a coleção para renomear a coluna 'url' para 'link'
            $data = $data->map(function ($item) {
                $item->link = $item->url;
                unset($item->url); // Remove a coluna original 'url'
                return $item;
            });

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
                    ->whereDate('end', '<=', $request->end)
                    ->get(['id', 'title', 'content', 'color', 'start', 'end', 'url']);

        // Mapear a coleção para renomear a coluna 'url' para 'link'
        $data = $data->map(function ($item) {
            $item->link = $item->url;
            unset($item->url); // Remove a coluna original 'url'
            return $item;
        });

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


}
