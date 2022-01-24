<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResourceCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'elements' => [],
            'total' => $this->resource['total']
        ];
        foreach ($this->resource['elements'] as $element) {
            $newElement = [];
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
                $newElement[$field] = $element->$field;
            }
            array_push($result['elements'], $newElement);
        }
        return $result;
    }
}