<?php

namespace App\Services\Countries\DTO;


class CreateCountryDTO
{

    private string $name;
    private string $continent_name;
    private int $status;
    private ?string $description;

    private function __construct(
        string $name,
        string $continent_name,
        int $status,
        ?string $description
    ) {
        $this->name = $name;
        $this->continent_name = $continent_name;
        $this->status = $status;
        $this->description = $description;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['continent_name'],
            $data['status'],
            $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'continent_name' => $this->continent_name,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }

}
