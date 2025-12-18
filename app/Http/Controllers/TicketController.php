<?php

namespace App\Http\Controllers;

use App\DTOs\CustomerDTO;
use App\DTOs\TicketDTO;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateStatusRequest;
use App\Http\Responses\ApiResponse;
use App\Services\CustomerService;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(
        private readonly TicketService $service
    )
    {}
    public function index(Request $request)
    {   
        $filter = [
            'name' => $request->query('name') ?? null,
            'email' => $request->query('email') ?? null,
            'status' => $request->query('status') ?? null,
            'phone_number' => $request->query('phone') ?? null,
            'date' => $request->query('date') ?? null,
        ];

        $tickets = $this->service->list($filter);
        $totalTickets = $this->service->totalTickets();
        $totalTicketsNew = $this->service->totalTicketsByStatus('new');

        if ($request->expectsJson()) {
            return ApiResponse::success([
                'tickets' => $tickets,
                'total_tickets' => $totalTickets,
                'total_tickets_new' => $totalTicketsNew,
            ]);
        }

        return view('dashboard', compact('tickets', 'totalTickets', 'totalTicketsNew'));
    }
    
    public function create()
    {
        return view('ticket');
    }

    public function store(TicketStoreRequest $request)
    {
        $ticket = $this->service->createWithCustomer(
            ticketDto: TicketDTO::fromArray($request->validated()),
            customerDto: CustomerDTO::fromArray($request->validated()['customer']),
            file: $request->file('customer.file') ?? null
        );

        if ($request->expectsJson()) {
            return ApiResponse::success($ticket, 201);
        }

        return view('ticket');
    }

    public function show($id)
    {
    }

    public function updateStatus(TicketUpdateStatusRequest $request, $id)
    {
        $ticket = $this->service->updateStatus(
            id: $id,
            status: $request->validated()['status']
        );

        if ($request->expectsJson()) {
            return ApiResponse::success($ticket, 200);
        }

        return redirect()->route('dashboard')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $this->service->delete($id);

        if ($request->expectsJson()) {
            return ApiResponse::success(message: 'Ticket deleted successfully');
        }

        return redirect()->route('dashboard')->with('success', 'Ticket updated successfully.');
    }
}
