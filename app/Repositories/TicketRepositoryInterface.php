<?php

namespace App\Repositories;

use App\DTOs\TicketDTO;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    public function list($filter): LengthAwarePaginator;

    public function find($id): Ticket;

    public function create(TicketDTO $data): Ticket;

    public function update($id, TicketDTO $data): Ticket;

    public function delete($id): void;

    public function totalTickets(): int;

    public function totalTicketsByStatus(string $status): int;
}