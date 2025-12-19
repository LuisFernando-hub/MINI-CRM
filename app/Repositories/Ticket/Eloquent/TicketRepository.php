<?php

namespace App\Repositories\Ticket\Eloquent;

use App\DTOs\Ticket\TicketDTO;
use App\DTOs\Ticket\TicketUpdateDTO;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

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

    public function update(Ticket $ticket, TicketUpdateDTO $data): Ticket
    {
        $ticket->update([
            'response' => $data->response ?? null,
            'status' => $data->status,
            'released_date' => now(),
        ]);

        return $ticket;
    }

    public function delete(Ticket $ticket): bool
    {
        return $ticket->delete();
    }

    public function totalTickets(): int
    {
        return Ticket::count();
    }

    public function totalTicketsByStatus(string $status): int
    {
        return Ticket::where('status', $status)->count();
    }

    public function totalTicketsByPeriod($status = null, string $period = 'daily'): int
    {
        $query = Ticket::query();

        if ($status) {
            $query->where('status', $status);
        }

        $today = Carbon::today();

        switch ($period) {
            case 'daily':
                $query->whereDate('created_at', $today);
                break;

            case 'weekly':
                $query->whereBetween('created_at', [$today->startOfWeek(), $today->endOfWeek()]);
                break;

            case 'monthly':
                $query->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year);
                break;

            default:
                throw new \InvalidArgumentException("Invalid period: $period");
        }

        return $query->count();
    }


    public function getStatistics(): array
    {
        return [
            'daily' => [
                'total' => $this->totalTicketsByPeriod(null, 'daily'),
                'new' => $this->totalTicketsByPeriod('new', 'daily'),
                'in_progress' => $this->totalTicketsByPeriod('in_progress', 'daily'),
                'resolved' => $this->totalTicketsByPeriod('resolved', 'daily'),
            ],
            'weekly' => [
                'total' => $this->totalTicketsByPeriod(null, 'weekly'),
                'new' => $this->totalTicketsByPeriod('new', 'weekly'),
                'in_progress' => $this->totalTicketsByPeriod('in_progress', 'weekly'),
                'resolved' => $this->totalTicketsByPeriod('resolved', 'weekly'),
            ],
            'monthly' => [
                'total' => $this->totalTicketsByPeriod(null, 'monthly'),
                'new' => $this->totalTicketsByPeriod('new', 'monthly'),
                'in_progress' => $this->totalTicketsByPeriod('in_progress', 'monthly'),
                'resolved' => $this->totalTicketsByPeriod('resolved', 'monthly'),
            ],
        ];
    }
}