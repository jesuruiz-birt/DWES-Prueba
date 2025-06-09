<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;

class EquiposController extends Controller
{
    public function index() {
        $equipos = Equipo::select('nombre', 'puntos')->get();

        // return response()->json(['equipos' => $equipos], 200);
        return response()->json($equipos, 200);
        
        /*
        $filtro="A";
        $equipos = DB::table('equipos')->where('nombre','like','%' . $filtro. '%')
            ->select('nombre', 'puntos')
            ->get(); 
        return response()->json($equipos);
        */
    }

    public function equipo($id)
    {
        try {
            $equipo = Equipo::findOrFail($id);
            return response()->json(['equipo' => $equipo], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al obtener el equipo: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function filtro($filtro) 
    {
        try {
            // $filtro="A";
            $equipos = DB::table('equipos')->where('nombre','like','%' . $filtro. '%')
                ->select('nombre', 'puntos')
                ->get(); 
            return response()->json($equipos);
        } catch (ModelFoundException $e) {
            return response()->json(['message' => 'No se ha encontrado nada con ese criterio'], 404);
        } catch (QueryException $e) {
            return response()-> json(['message => Error al obtener los datos: ' . $e->getMessage()], 500);
        } catch (\Exception $e){
            return response()->json(['message' => 'Error inesperado: ' . $e->getMessage()], 500);
        }

    }

    public function nuevo_equipo(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'puntos' => 'required|integer',
            ]);

            $equipo = Equipo::create($request->all());

            return response()->json(['message' => 'Equipo creado correctamente', 'equipo' => $equipo], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha habido un error: ' . $e->getMessage()], 500);
        }
    }

    public function mod_equipo(Request $request, $id) {
        try {

            $equipo = Equipo::findOrFail($id);

            $request->validate([
                'nombre' => 'required|string',
                'puntos' => 'required|integer',
            ]);
            
            // update() debe ejecutarse sobre un objeto de modelo ya instanciado, no directamente en la clase Equipo.
            // $equipo = Equipo::update($request->all());

            // Aquí se llama a update() sobre la instancia del modelo
            $equipo->update($request->all());

            return response()->json(['message' => 'Equipo actualizado correctamente', 'equipo' => $equipo], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al actualizar el equipo: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha habido un error: ' . $e->getMessage()], 500);
        }
    }

    public function borrar_equipo($id) {
               try {

            $equipo = Equipo::findOrFail($id);

            $equipo->delete();

            return response()->json(['message' => 'Equipo ' . $id . ' ' . $equipo->nombre .' eliminado correctamente'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al eliminar el Equipo: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }
}
