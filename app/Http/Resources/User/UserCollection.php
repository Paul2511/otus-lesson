<?php


namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;
class UserCollection extends ResourceCollection
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
            ['key'=>'name', 'label'=>__('user.label.name'), 'sort'=>true],
            ['key'=>'role', 'label'=>__('user.label.role'), 'sort'=>true],
            ['key'=>'status', 'label'=>__('user.label.status'), 'sort'=>true],
            ['key'=>'email', 'label'=>__('user.label.email'), 'sort'=>true],
            ['key'=>'created_at', 'label'=>__('user.label.created_at'), 'sort'=>true],
            ['key'=>'petsCount', 'label'=>__('user.label.petsCount'), 'sort'=>false],
        ];

        return [
            'data' => $this->collection,
            'fields' => $fields,
        ];
    }
}