<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'category_id',
            'title',
            'slug',
            'description',
            'summary',
            'content',
            'status',
            'comments',
            'featured',
        ];
        foreach ($array_field as $field) {
            $result[$field] = $this->$field;
        }
       
        return $result;
    }
}
