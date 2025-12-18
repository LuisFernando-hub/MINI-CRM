<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject'               => 'required|string|max:255',
            'description'           => 'required|string|max:255',

            'customer.name'         => 'required|string|max:255',
            'customer.email'        => 'required|email|max:255',
            'customer.phone_number' => 'string|max:255|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required'       => 'The ticket subject is required.',
            'subject.min'            => 'The ticket subject must be at least :min characters.',

            'description.required'   => 'The ticket description is required.',
            'description.min'        => 'The ticket description must be at least :min characters.',

            'customer.name.required' => 'The customer name is required.',
            'customer.email.required'=> 'The customer email is required.',
            'customer.email.email'   => 'Please provide a valid customer email address.',
        ];
    }

    public function attributes(): array
    {
        return [
            'subject'          => 'ticket subject',
            'description'      => 'ticket description',
            'customer.name'    => 'customer name',
            'customer.email'   => 'customer email',
        ];
    }
}