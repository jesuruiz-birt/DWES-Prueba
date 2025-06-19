<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\UserData; // Tu DTO
use App\Http\Requests\StoreUserDataRequest; // Tu Form Request

class DataReceiverController extends Controller
{
    /**
     * Procesa los datos recibidos del cliente usando un Form Request y un DTO.
     *
     * @param  \App\Http\Requests\StoreUserDataRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processData(StoreUserDataRequest $request): JsonResponse
    {
        // Si el código llega aquí, los datos ya han sido validados por StoreUserDataRequest.
        // Ahora puedes crear tu DTO con los datos validados.
        $userData = new UserData($request->validated()); // validated() devuelve solo los datos validados

        // Acceder a los datos de forma tipada
        $nombre = $userData->nombre;
        $email = $userData->email;
        $edad = $userData->edad;

        // Aquí tu lógica de negocio...

        return response()->json([
            'message' => 'Datos de usuario recibidos y procesados con éxito!',
            'processed_data' => $userData->toArray()
        ], 200);
    }
}