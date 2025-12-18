<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:new,in_progress,processed',
            'response' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required'       => 'The ticket status is required.',
            'status.in'             => 'The selected ticket status is invalid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'ticket status',
        ];
    }
}