<?php

namespace App\Models; // O App\DTOs;

use Illuminate\Contracts\Support\Arrayable; // Opcional, para convertir a array fácilmente

class UserData implements Arrayable
{
    public string $nombre;
    public string $email;
    public int $edad;

    /**
     * Constructor para crear una instancia del modelo desde un array de datos.
     *
     * @param array $data Los datos recibidos (ej. de $request->all())
     */
    public function __construct(array $data)
    {
        // Puedes agregar validaciones básicas aquí o en el Request Form si es más complejo
        if (!isset($data['nombre']) || !is_string($data['nombre'])) {
            throw new \InvalidArgumentException('El campo "nombre" es requerido y debe ser una cadena.');
        }
        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('El campo "email" es requerido y debe ser un email válido.');
        }
        if (!isset($data['edad']) || !is_int($data['edad']) || $data['edad'] <= 0) {
            throw new \InvalidArgumentException('El campo "edad" es requerido y debe ser un número entero positivo.');
        }

        $this->nombre = $data['nombre'];
        $this->email = $data['email'];
        $this->edad = $data['edad'];
    }

    /**
     * Convierte el modelo a un array (útil para devolverlo como JSON).
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'email' => $this->email,
            'edad' => $this->edad,
        ];
    }

    // Opcional: Métodos para obtener datos individualmente si lo prefieres
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEdad(): int
    {
        return $this->edad;
    }
}