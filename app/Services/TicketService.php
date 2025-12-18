<?php

namespace App\Services;

use App\DTOs\TicketDTO;
use App\Models\Ticket;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class TicketService
{
    public function __construct(
        private readonly TicketRepositoryInterface $repository
    ) {}

    public function list($filter): LengthAwarePaginator
    {
        return $this->repository->list($filter);
    }

    public function create(TicketDTO $data): Ticket
    {
        $dto = new TicketDTO(
            subject: $data->subject,
            description: $data->description,
            status: $data->status,
            customerId: $data->customerId,
        );

        return $this->repository->create($dto);
    }

    public function find($id): Ticket
    {
        return $this->repository->find($id);
    }

    public function update($id, TicketDTO $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }

    public function totalTickets(): int
    {
        return $this->repository->totalTickets();
    }

    public function totalTicketsByStatus(string $status): int
    {
        return $this->repository->totalTicketsByStatus($status);
    }
}