<?php

namespace App\Services\Categories\DTO;

class CreateCategoryDTO {
    
    private int $parent_id;
    private string $title;
    private int $status;
    
    public function __construct(
            int $parent_id,
            string $title,
            int $status
    ) {
        $this->parent_id = $parent_id;
        $this->title = $title;
        $this->status = $status;
    }
    public static function fromArray(array $data){
        return new static(
                $data['parent_id'],
                $data['title'],
                $data['status']
           );
    }


    public function toArray():array{
        return [
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'status' => $this->status
            ];
    }
}
