<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{

    public function toArray($request)
    {
        return [
            'firstname' => $this->firstname,
            'prefix' => $this->prefix,
            'surname' => $this->surname,
            'email' => $this->email,
            'uniqueCode' => $this->uniqueCode,
            'role' => $this->role->name

        ];
    }
}
