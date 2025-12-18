<?php

namespace App\Services;

use App\DTOs\CustomerDTO;
use App\DTOs\TicketDTO;
use App\Models\Ticket;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


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

    public function update($id, TicketDTO $data)
    {
        return $this->repository->update($id, $data);
    }
    
    public function updateStatus($id, $status)
    {
        return $this->repository->updateStatus($id, $status);
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