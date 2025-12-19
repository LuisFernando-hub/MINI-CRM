<?php

namespace App\Http\Controllers;

use App\DTOs\Customer\CustomerDTO;
use App\DTOs\Ticket\TicketDTO;
use App\DTOs\Ticket\TicketUpdateDTO;
use App\Http\Requests\Ticket\TicketStoreRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Http\Responses\ApiResponse;
use App\Http\Responses\TicketApiResponse;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(
        private readonly TicketService $service
    )
    {}

    /**
     * @OA\Get(
     *     path="/api/tickets",
     *     summary="List All Tickets",
     *     tags={"Tickets"},
     *     @OA\Response(
     *         response=200,
     *         description="List Tickets",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="tickets",
     *                     type="object",
     *                     @OA\Property(property="current_page", type="integer", example=1),
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="customer_id", type="integer", example=6),
     *                             @OA\Property(property="subject", type="string", example="Miss"),
     *                             @OA\Property(property="description", type="string", example="Nihil rerum..."),
     *                             @OA\Property(property="status", type="string", example="new"),
     *                             @OA\Property(property="released_date", type="string", format="date", example="2025-12-18"),
     *                             @OA\Property(property="response", type="string", example="Refunded for 1 month"),
     *                             @OA\Property(
     *                                 property="customer",
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=6),
     *                                 @OA\Property(property="name", type="string", example="Ms. Kyra Hackett Jr."),
     *                                 @OA\Property(property="email", type="string", example="schultz.christop@example.net"),
     *                                 @OA\Property(property="phone_number", type="string", example="+1-915-609-3069"),
     *                                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                                 @OA\Property(property="media", type="array", @OA\Items(type="string"))
     *                             )
     *                         )
     *                     ),
     *                     @OA\Property(property="first_page_url", type="string", example="http://localhost:8000/api/tickets?page=1"),
     *                     @OA\Property(property="from", type="integer", example=1),
     *                     @OA\Property(property="last_page", type="integer", example=1),
     *                     @OA\Property(property="last_page_url", type="string", example="http://localhost:8000/api/tickets?page=1"),
     *                     @OA\Property(
     *                         property="links",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="url", type="string", nullable=true),
     *                             @OA\Property(property="label", type="string"),
     *                             @OA\Property(property="page", type="integer", nullable=true),
     *                             @OA\Property(property="active", type="boolean")
     *                         )
     *                     ),
     *                     @OA\Property(property="next_page_url", type="string", nullable=true),
     *                     @OA\Property(property="path", type="string", example="http://localhost:8000/api/tickets"),
     *                     @OA\Property(property="per_page", type="integer", example=10),
     *                     @OA\Property(property="prev_page_url", type="string", nullable=true),
     *                     @OA\Property(property="to", type="integer", example=6),
     *                     @OA\Property(property="total", type="integer", example=6)
     *                 ),
     *                 @OA\Property(property="total_tickets", type="integer", example=6),
     *                 @OA\Property(property="total_tickets_new", type="integer", example=2)
     *             )
     *         )
     *     )
     * )
     */
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
        return response()->view('ticket')->header('X-Frame-Options', 'ALLOWALL'); 
    }


    /**
     * @OA\POST(
     *     tags={"Tickets"},
     *     path="/api/tickets",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="subject", type="string", example="Bug login"),
     *              @OA\Property(property="description", type="string", example="Error"),
     *              @OA\Property(property="customer", type="object",
     *                 @OA\Property(property="name", type="string", example="Teste"),
     *                 @OA\Property(property="email", type="string", example="teste@teste.com"),
     *                 @OA\Property(property="phone_number", type="string", example="11999999999"),
     *                 @OA\Property(property="file", type="string", format="binary", example="null"),
     *             )             
     *          )
     *     ),
     *     summary="Create Tickets",
     *     @OA\Response(
     *         response=200,
     *         description="Create Tickets",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success, error"),
     *             @OA\Property(property="message", type="string", example="Success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="tickets", ref="#/components/schemas/Ticket"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Ticket not found")
     *         )
     *     )
     *   )
     * )
     */
    public function store(TicketStoreRequest $request)
    {
        $ticket = $this->service->createWithCustomer(
            ticketDto: TicketDTO::fromArray($request->validated()),
            customerDto: CustomerDTO::fromArray($request->validated()['customer']),
            file: $request->file('customer.file') ?? null
        );

        if ($request->expectsJson()) {
            return TicketApiResponse::success($ticket, 201);
        }

        return view('ticket', ['success' => 'Ticket created successfully.']);
    }

    public function show($id)
    {
    }

    /**
     * @OA\PUT(
     *     tags={"Tickets"},
     *     path="/api/tickets",
     *     summary="Update Tickets",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="string", example="new"),
     *              @OA\Property(property="response", type="string", example="Ajust fixed"),
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Update Tickets",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success, error"),
     *             @OA\Property(property="message", type="string", example="Success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="tickets", ref="#/components/schemas/Ticket"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Ticket not found")
     *         )
     *     )
     *   )
     * )
     */
    public function update(TicketUpdateRequest $request, $id)
    {
        try {
            $ticket = $this->service->update($id, TicketUpdateDTO::fromArray($request->validated()));

            if ($request->expectsJson()) {
                return TicketApiResponse::success($ticket, 200);
            }

            return redirect()->route('dashboard')->with('success', 'Ticket updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return TicketApiResponse::error('error', 404, 'Error update ticket');
            }

            return redirect()->route('dashboard')->with('error', 'Error update ticket');
        }
        
    }

    /**
     * @OA\Delete(
     *     tags={"Tickets"},
     *     path="/api/tickets/{id}",
     *     summary="Delete a Ticket",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do ticket a ser deletado",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Ticket deleted successfully"),
     *             @OA\Property(property="data", type="object", example={})
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Ticket not found")
     *         )
     *     )
     * )
     */
    public function destroy(Request $request, $id = null)
    {
        try {
            $this->service->delete($id);

            if ($request->expectsJson()) {
                return TicketApiResponse::success(message: 'Ticket deleted successfully');
            }

            return redirect()->route('dashboard')->with('success', 'Ticket deleted successfully.');
        } catch (\Exception $e) {

            if ($request->expectsJson()) {
                return TicketApiResponse::error('error', 404, 'Error delete ticket');
            }

            return redirect()->route('dashboard')->with('error', 'Error delete ticket');
        }
    }

    /**
     * @OA\Get(
     *     tags={"Tickets"},
     *     path="/api/tickets/statistics",
     *     summary="Get ticket statistics (daily, weekly, monthly)",
     *     description="Returns total tickets grouped by status for daily, weekly, and monthly periods.",
     *     @OA\Response(
     *         response=200,
     *         description="Ticket statistics",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="daily",
     *                     type="object",
     *                     @OA\Property(property="total", type="integer", example=5),
     *                     @OA\Property(property="new", type="integer", example=1),
     *                     @OA\Property(property="in_progress", type="integer", example=3),
     *                     @OA\Property(property="resolved", type="integer", example=0)
     *                 ),
     *                 @OA\Property(
     *                     property="weekly",
     *                     type="object",
     *                     @OA\Property(property="total", type="integer", example=0),
     *                     @OA\Property(property="new", type="integer", example=0),
     *                     @OA\Property(property="in_progress", type="integer", example=0),
     *                     @OA\Property(property="resolved", type="integer", example=0)
     *                 ),
     *                 @OA\Property(
     *                     property="monthly",
     *                     type="object",
     *                     @OA\Property(property="total", type="integer", example=5),
     *                     @OA\Property(property="new", type="integer", example=1),
     *                     @OA\Property(property="in_progress", type="integer", example=3),
     *                     @OA\Property(property="resolved", type="integer", example=0)
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function statistics()
    {
        $statistics = $this->service->getStatistics();

        return ApiResponse::success($statistics);
    }
}
