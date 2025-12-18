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

    public function update($id, TicketUpdateDTO $data): Ticket;

    public function delete($id): void;

    public function totalTickets(): int;

    public function totalTicketsByStatus(string $status): int;
}