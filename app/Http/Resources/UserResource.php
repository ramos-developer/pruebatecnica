<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [];
        $array_field = [
            'id',
            'email',
            'password',
            'remember_token',
            'email_verified_at',
        ];
        foreach ($array_field as $field) {
            $result[$field] = $this->$field;
        }

        return $result;
    }
}
