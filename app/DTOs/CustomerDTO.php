<?php

namespace App\DTOs;

class CustomerDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $phone_number
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone_number: $data['phone_number'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number ?? null
        ]);
    }
}