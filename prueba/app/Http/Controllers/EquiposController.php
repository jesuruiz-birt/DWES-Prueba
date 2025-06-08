<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;

class EquiposController extends Controller
{
    public function index() {
        // $equipos = Equipo::all(); 
        // return response()->json(['equipos' => $equipos], 200);
        // return response()->json($equipos);

        $filtro="A";
        $equipos = DB::table('equipos')->where('nombre','like','%' . $filtro. '%')
            ->select('nombre', 'puntos')
            ->get(); 
        return response()->json($equipos);
    }

    public function nuevo_equipo(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'puntos' => 'required|integer',
            ]);

            $equipo = Equipo::create($request->all());

            return response()->json(['message' => 'Equipo creado correctamente', 'artista' => $equipo], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha habido un error: ' . $e->getMessage()], 500);
        }
    }
}
