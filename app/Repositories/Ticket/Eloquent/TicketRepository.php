<?php

namespace App\Repositories\Ticket\Eloquent;

use App\DTOs\Ticket\TicketDTO;
use App\DTOs\Ticket\TicketUpdateDTO;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TicketRepository implements TicketRepositoryInterface
{
    public function list($filter): LengthAwarePaginator
    {
        $query = Ticket::query()->with('customer', 'customer.media');

        if (!empty($filter['email'])) {
           $query->whereHas('customer', function ($q) use ($filter) {
                $q->where('email', $filter['email']);
            });
        }

        if (!empty($filter['status'])) {
            $query->where('status', $filter['status']);
        }

        if (!empty($filter['phone_number'])) {
            $query->whereHas('customer', function ($q) use ($filter) {
                $q->where('phone_number', $filter['phone_number']);
            });
        }

        if (!empty($filter['date'])) {
            $query->whereDate('created_at', $filter['date']);
        }

         return $query->paginate( 10)->appends(request()->query());
    }

    public function find($id): Ticket
    {
        return Ticket::findOrFail($id);
    }

    public function create(TicketDTO $data): Ticket
    {
        return Ticket::create($data->toArray());
    }

    public function update($id, TicketUpdateDTO $data): Ticket
    {
        $ticket = $this->find($id);
        
        $ticket->update([
            'response' => $data->response ?? null,
            'status' => $data->status,
            'released_date' => now(),
        ]);

        return $ticket;
    }

    public function delete($id): void
    {
        $ticket = $this->find($id);
        $ticket->delete();
    }

    public function totalTickets(): int
    {
        return Ticket::count();
    }

    public function totalTicketsByStatus(string $status): int
    {
        return Ticket::where('status', $status)->count();
    }
}