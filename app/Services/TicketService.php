<?php

namespace App\Services;

use App\DTOs\Customer\CustomerDTO;
use App\DTOs\Ticket\TicketDTO;
use App\DTOs\Ticket\TicketUpdateDTO;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketService
{
    public function __construct(
        private readonly TicketRepositoryInterface $repository,
        private readonly CustomerService $customerService
    ) {}

    public function list($filter): LengthAwarePaginator
    {
        return $this->repository->list($filter);
    }

    public function createWithCustomer(
        TicketDTO $ticketDto,
        CustomerDTO $customerDto,
        $file = null
    ): Ticket {
        $customer = $this->customerService->create($customerDto, $file);

        $ticketDto = $ticketDto->withCustomerId($customer->id);

        return $this->repository->create($ticketDto);
    }

    public function find($id): Ticket
    {
        return $this->repository->find($id);
    }

    public function update($id, TicketUpdateDTO $data): Ticket
    {
        $ticket = $this->repository->find($id);

        if (!$ticket) {
            throw new ModelNotFoundException("Ticket with id {$id} not found");
        }

        return $this->repository->update($ticket, $data);
    }
    
    public function delete($id): void
    {
        $ticket = $this->repository->find($id);

        if (!$ticket) {
            throw new ModelNotFoundException("Ticket with id {$id} not found");
        }

        $this->repository->delete($ticket);
    }

    public function totalTickets(): int
    {
        return $this->repository->totalTickets();
    }

    public function totalTicketsByStatus(string $status): int
    {
        return $this->repository->totalTicketsByStatus($status);
    }

    public function getStatistics(): array
    {
        return $this->repository->getStatistics();
    }
}