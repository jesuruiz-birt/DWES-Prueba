<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; 
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function usuarios(){
        // $usuarios = Usuario::all();
        $usuarios = Usuario::select('id', 'nombre', 'pass')->get();
        return response() -> json(['usuarios' => $usuarios], 200);
    }

    public function usuario($id){
        // $usuarios = Usuario::all();
        $usuario = Usuario::select('id', 'nombre', 'pass')->findOrFail($id);

        return response() -> json(['usuario' => $usuario], 200);
    }


    public function nuevo_usuario(Request $request){
        try {
            $request->validate ([
                'nombre' => 'required|string',
                'pass' => 'required|string'
            ]);
        
            $usuario = Usuario::create($request->all());

            return response() -> json([
                'message' => 'Usuario creado correctamente',
                'usuario' => $usuario], 
                201
            );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado' . $e->getMessage()], 500);

        }
    }

    public function mod_usuario(Request $request, $id){
        try {
            $usuario = Usuario::findOrFail($id);
            //$usuario = Usuario::select('id', 'nombre', 'pass')->findOrFail($id);

            $request->validate ([
                'nombre' => 'required|string',
                'pass' => 'required|string'
            ]);
            /*
            // 🔍 Comparamos el nuevo hash con el que ya está guardado
            if (Hash::check($request->pass, $usuario->pass)) {
                return response()->json(['message' => 'La nueva contraseña debe ser diferente a la anterior'], 400);
            }

            // ✅ Si es diferente, la hasheamos antes de actualizar
            $usuario->update([
                'nombre' => $request->nombre,
                'pass' => Hash::make($request->pass)
            ]);
            // $usuario->update($request->all());

            return response() -> json([
                'message' => 'Usuario modificado correctamente',
                'usuario' => $usuario],
                200
            );
            */

        // ✅ Mostramos las contraseñas para ver qué se está comparando
        return response()->json([
            'contraseña en texto plano' => $request->pass,
            'contraseña almacenada (hash)' => $usuario->pass,
            'comparación' => Hash::check($request->pass, $usuario->pass) ? 'Son iguales' : 'Son diferentes'
        ], 200);



        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado' . $e->getMessage()], 500);

        }
    }

    public function borrar_usuario($id) {
        try {
            $usuario = Usuario::findOrFail($id);

            $usuario->delete();

            return response()->json(['message' => 'Usuario ' . $id . ' - ' . $usuario->nombre . ' se ha eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error inesperado ' . $e.getMessage()], 500);
        }
    }
}
