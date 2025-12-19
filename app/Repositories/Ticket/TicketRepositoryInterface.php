<?php

namespace App\Repositories\Ticket;

use App\DTOs\Ticket\TicketDTO;
use App\DTOs\Ticket\TicketUpdateDTO;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    public function list($filter): LengthAwarePaginator;

    public function find($id): Ticket;

    public function create(TicketDTO $data): Ticket;

    public function update(Ticket $ticket, TicketUpdateDTO $data): Ticket;

    public function delete(Ticket $ticket): bool;

    public function totalTickets(): int;

    public function totalTicketsByStatus(string $status): int;
    public function getStatistics(): array;
}