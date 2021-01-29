<?php


namespace Support\Person\PersonName;

use Spatie\DataTransferObject\DataTransferObject;

class PersonNameData extends DataTransferObject
{
    public ?string $lastName;
    public ?string $firstName;
    public ?string $middleName;
    public ?string $fullName;
    public ?string $shortName;
    public ?string $displayName;

    public static function fromFullName(?string $fullName): self
    {
        $data = [];
        if ($fullName) {
            $parts = explode(' ', $fullName);
            $lastName = $parts[0];
            $firstName = $parts[1] ?? null;
            $middleName = $parts[2] ?? null;
            $data = [
                'fullName'=>$fullName,
                'lastName'=>$lastName,
                'firstName'=>$firstName,
                'middleName'=>$middleName
            ];
        }

        return self::fromArray($data);
    }

    public static function fromArray(array $data): self
    {
         $personName = new self($data);

         return $personName->withFullName()->withShortName()->withDisplayName();
    }

    public function withFullName(): self
    {
        if (!$this->fullName) {
            $this->getFullName();
        }

        return $this;
    }

    public function getFullName()
    {
        $lastName = $this->lastName?$this->lastName.' ':'';
        $firstName = $this->firstName?$this->firstName.' ':'';
        $middleName = $this->middleName ?? '';
        return $this->fullName = trim($lastName . $firstName . $middleName);
    }

    protected function withShortName(): self
    {
        if (!$this->shortName) {
            $firstName = $this->firstName ? mb_substr($this->firstName, 0, 1).'.' : null;
            $middleName = $this->middleName ? mb_substr($this->middleName, 0, 1).'.' : null;
            $shortName = trim(implode(' ', [$this->lastName, $firstName, $middleName]));
            $shortName = preg_replace('~\s+~', ' ', $shortName);
            $this->shortName = $shortName ?? null;
        }

        return $this;
    }

    protected function withDisplayName(): self
    {
        if (!$this->displayName) {
            $lastName = $this->lastName?$this->lastName.' ':'';
            $firstName = $this->firstName?$this->firstName.' ':'';
            $displayName = trim($lastName . $firstName);
            $this->displayName = $displayName ?? null;
        }
        return $this;
    }
}