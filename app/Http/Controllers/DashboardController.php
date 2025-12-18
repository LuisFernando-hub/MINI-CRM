<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ticketsService = app(TicketService::class);

        $filter = [
            'name' => $request->query('name') ?? null,
            'email' => $request->query('email') ?? null,
            'status' => $request->query('status') ?? null,
            'phone_number' => $request->query('phone') ?? null,
            'date' => $request->query('date') ?? null,
        ];

        $tickets = $ticketsService->list($filter);
        $totalTickets = $ticketsService->totalTickets();
        $totalTicketsNew = $ticketsService->totalTicketsByStatus('new');
        $totalTicketsInProgess = $ticketsService->totalTicketsByStatus('in_progress');
        $totalTicketsProcessed = $ticketsService->totalTicketsByStatus('processed');

        return view('dashboard', compact('tickets', 'totalTickets', 'totalTicketsNew', 'totalTicketsInProgess', 'totalTicketsProcessed'));
    }
}
