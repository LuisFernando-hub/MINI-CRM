<?php

namespace App\DTOs;

class TicketDTO
{
    public function __construct(
        public readonly string $subject,
        public readonly string $description,
        public readonly string $status,
        public readonly int $customerId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            subject: $data['subject'],
            description: $data['description'],
            status: $data['status'],
            customerId: $data['customer_id'],
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'subject' => $this->subject,
            'description' => $this->description,
            'status' => $this->status,
            'customer_id' => $this->customerId,
        ]);
    }
}