<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'full_name' => $this->full_name,

            // Mostrara solo cuando sea un admin, el email
            'email' => $this->when($request->user()->isAdmin(), $this->email)
        ];
    }

    // Se añadira a la respuesta del recurso, solo cuando retorne un modelo pero no en una coleccion
    public function with($request)
    {
        return [
            'success' => true
        ];
    }
}
