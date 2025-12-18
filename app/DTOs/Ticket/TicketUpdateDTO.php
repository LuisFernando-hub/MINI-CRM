<?php

namespace App\DTOs\Ticket;

use App\Enums\TicketStatus;

class TicketUpdateDTO
{
    public function __construct(
        public readonly ?string $response,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            response: $data['response'] ?? null,
            status: $data['status'] ?? TicketStatus::fromValue('new'),
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'response' => $this->response ?? null,
            'status' => $this->status ?? TicketStatus::fromValue('new'),
        ]);
    }

}