<?php

namespace App\Http\Controllers;

use App\DTOs\TicketDTO;
use App\Http\Requests\TicketRequest;
use App\Http\Responses\ApiResponse;
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

        return view('dashboard', compact('tickets', 'totalTickets', 'totalTicketsNew'));
    }

    public function store(TicketRequest $request)
    {
        $dto = TicketDTO::fromArray($request->validated());

        $ticket = $this->service->create($dto);

        return ApiResponse::success($ticket, 201);
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
