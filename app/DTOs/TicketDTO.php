<?php

namespace App\DTOs;

use App\Enums\TicketStatus;

class TicketDTO
{
    public function __construct(
        public readonly string $subject,
        public readonly string $description,
        public readonly string $status,
        public readonly ?int $customerId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            subject: $data['subject'],
            description: $data['description'],
            status: $data['status'] ?? TicketStatus::fromValue(0),
            customerId: $data['customer_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'subject' => $this->subject,
            'description' => $this->description,
            'status' => $this->status ?? TicketStatus::fromValue(0),
            'customer_id' => $this->customerId ?? null,
        ]);
    }

    public function withCustomerId(int $customerId): self
    {
        return new self(
            subject: $this->subject,
            description: $this->description,
            status: $this->status,
            customerId: $customerId
        );
    }
}