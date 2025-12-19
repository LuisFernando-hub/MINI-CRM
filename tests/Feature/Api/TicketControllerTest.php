<?php

namespace Tests\Feature\Api;

use App\Enums\TicketStatus;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    // use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function can_create_ticket_with_customer_and_file()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('document.pdf', 100);

        $payload = [
            'subject' => 'Test Ticket',
            'description' => 'Ticket description',
            'customer' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'file' => $file,
            ],
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->postJson('/api/tickets', $payload);

        $response->assertStatus(200);
    }

    /** @test */
    public function validation_fails_when_required_fields_are_missing()
    {
        $response = $this->actingAs($this->user, 'sanctum')
                         ->postJson('/api/tickets', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['subject', 'description', 'customer.name', 'customer.email']);
    }

    /** @test */
    public function can_update_ticket()
    {
        $ticket = Ticket::factory()->create([
            'subject' => 'Old Subject',
            'description' => 'Old description',
        ]);

        $payload = [
            'status' => TicketStatus::IN_PROGRESS->value,
            'response' => 'Finish',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->putJson("/api/tickets/{$ticket->id}", $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => TicketStatus::IN_PROGRESS->value,
            'response' => 'Finish',
        ]);
    }

    /** @test */
    public function update_fails_when_ticket_not_found()
    {
        $payload = [
            'status' => TicketStatus::IN_PROGRESS->value,
            'response' => 'Finish',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->putJson("/api/tickets/9999", $payload);

        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->deleteJson("/api/tickets/{$ticket->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'success']);

        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
        ]);
    }

    /** @test */
    public function delete_fails_when_ticket_not_found()
    {
        $response = $this->actingAs($this->user, 'sanctum')
                         ->deleteJson("/api/tickets/9999");

        $response->assertStatus(404);
    }
}
