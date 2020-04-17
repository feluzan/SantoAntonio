<?php namespace Tests\Repositories;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TicketRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TicketRepository
     */
    protected $ticketRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ticketRepo = \App::make(TicketRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ticket()
    {
        $ticket = factory(Ticket::class)->make()->toArray();

        $createdTicket = $this->ticketRepo->create($ticket);

        $createdTicket = $createdTicket->toArray();
        $this->assertArrayHasKey('id', $createdTicket);
        $this->assertNotNull($createdTicket['id'], 'Created Ticket must have id specified');
        $this->assertNotNull(Ticket::find($createdTicket['id']), 'Ticket with given id must be in DB');
        $this->assertModelData($ticket, $createdTicket);
    }

    /**
     * @test read
     */
    public function test_read_ticket()
    {
        $ticket = factory(Ticket::class)->create();

        $dbTicket = $this->ticketRepo->find($ticket->id);

        $dbTicket = $dbTicket->toArray();
        $this->assertModelData($ticket->toArray(), $dbTicket);
    }

    /**
     * @test update
     */
    public function test_update_ticket()
    {
        $ticket = factory(Ticket::class)->create();
        $fakeTicket = factory(Ticket::class)->make()->toArray();

        $updatedTicket = $this->ticketRepo->update($fakeTicket, $ticket->id);

        $this->assertModelData($fakeTicket, $updatedTicket->toArray());
        $dbTicket = $this->ticketRepo->find($ticket->id);
        $this->assertModelData($fakeTicket, $dbTicket->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ticket()
    {
        $ticket = factory(Ticket::class)->create();

        $resp = $this->ticketRepo->delete($ticket->id);

        $this->assertTrue($resp);
        $this->assertNull(Ticket::find($ticket->id), 'Ticket should not exist in DB');
    }
}
