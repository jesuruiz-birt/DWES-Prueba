<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserDataRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Si necesitas autorización, podrías verificarla aquí
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'edad' => ['required', 'integer', 'min:1', 'max:150'],
        ];
    }

    /**
     * Obtiene los mensajes de error personalizados para las reglas de validación.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo "nombre" es obligatorio.',
            'email.required' => 'El campo "email" es obligatorio.',
            'email.email' => 'El campo "email" debe ser una dirección de correo válida.',
            'edad.required' => 'El campo "edad" es obligatorio.',
            'edad.integer' => 'El campo "edad" debe ser un número entero.',
            'edad.min' => 'El campo "edad" debe ser un valor positivo.'
        ];
    }
}