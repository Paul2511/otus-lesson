<?php


namespace App\Http\Resources\Pet;

use Illuminate\Http\Resources\Json\ResourceCollection;
class PetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fields = [
            ['key'=>'id', 'label'=>'id',  'sort'=>true],
            ['key'=>'name', 'label'=>__('pet.label.name'), 'sort'=>true],
            ['key'=>'client_id', 'label'=>__('pet.label.clientName'), 'sort'=>true],
            ['key'=>'pet_type_id', 'label'=>__('pet.label.type'), 'sort'=>true],
            ['key'=>'sex', 'label'=>__('pet.label.sex'), 'sort'=>true],
            ['key'=>'created_at', 'label'=>__('pet.label.created_at'), 'sort'=>true],
        ];

        return [
            'data' => $this->collection,
            'fields' => $fields,
        ];
    }
}