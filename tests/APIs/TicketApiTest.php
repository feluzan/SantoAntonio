<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Ticket;

class TicketApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ticket()
    {
        $ticket = factory(Ticket::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tickets', $ticket
        );

        $this->assertApiResponse($ticket);
    }

    /**
     * @test
     */
    public function test_read_ticket()
    {
        $ticket = factory(Ticket::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tickets/'.$ticket->id
        );

        $this->assertApiResponse($ticket->toArray());
    }

    /**
     * @test
     */
    public function test_update_ticket()
    {
        $ticket = factory(Ticket::class)->create();
        $editedTicket = factory(Ticket::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tickets/'.$ticket->id,
            $editedTicket
        );

        $this->assertApiResponse($editedTicket);
    }

    /**
     * @test
     */
    public function test_delete_ticket()
    {
        $ticket = factory(Ticket::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tickets/'.$ticket->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tickets/'.$ticket->id
        );

        $this->response->assertStatus(404);
    }
}
