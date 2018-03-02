<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PopularTicketsTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_see_popular_tickets()
    {
        $popularTicket = seed('Ticket');
        $user = seed('User');
        $ticket = seed('Ticket');

        $votes = seed('Vote', 10, ['ticket_id' => $popularTicket->id]);
        $votes = seed('Vote', 2, ['ticket_id' => $ticket->id]);

        $this->actingAs($user)
            ->visit('/')
            ->click('Populares')
            ->seeInElement('h1', 'Solicitudes populares')
            ->see($popularTicket->title)
            ->see('10 votos')
            ->dontSee($ticket->title)
            ->dontSee('2 votos');
    }
}
