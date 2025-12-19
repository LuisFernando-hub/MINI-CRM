<?php

namespace App\Http\Responses;


class TicketApiResponse
{
    public static function success($ticket = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $ticket ? array_merge(
                auth()->check() ? ['id' => $ticket->id] : [],
                [
                    'subject' => $ticket->subject,
                    'description' => $ticket->description,
                    'status' => $ticket->status,
                    'response' => $ticket->response,
                    'released_date' => $ticket->released_date,
                    'customer' => [
                        'name' => $ticket->customer->name,
                        'email' => $ticket->customer->email,
                        'phone_number' => $ticket->customer->phone_number,
                    ],
                ]
            ) : null,
        ], $statusCode);
    }

    public static function error($message = 'Error', $statusCode = 400, $errors = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}