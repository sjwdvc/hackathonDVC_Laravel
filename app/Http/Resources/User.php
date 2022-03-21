<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Course as CourseResource;
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
            'role' => $this->role->name,
//            'courses' => CourseResource::collection($this->courses)
        ];
    }
}
