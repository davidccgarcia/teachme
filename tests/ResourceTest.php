<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase
{
    use DatabaseTransactions;

    protected $title = 'Curso de patrones de diseño';
    protected $link = 'https://styde.net';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_resource()
    {
        $user = seed('User');

        $this->actingAs($user)
            ->visit(route('tickets.latest'))
            ->click('Nueva solicitud')
            ->seePageIs(route('tickets.request'))
            ->seeInElement('h2', 'Nueva Solicitud')
            ->type($this->title, 'title')
            ->type($this->link, 'link')
            ->press('Enviar Solicitud')
            ->seeInDatabase('tickets', [
                'title' => $this->title, 'link' => $this->link, 'status' => 'closed'
            ])
            ->see($this->title)
            ->seeLink('Ver recurso', $this->link);
    }

    /**
    *
    */
    public function test_select_resource()
    {
        // Having
        $user = seed('User');
        $ticket = seed('Ticket', [
            'title' => $this->title, 'user_id' => $user->id, 'status' => 'open' 
        ]);
        $comment = seed('Comment', [
            'ticket_id' => $ticket->id, 'link' => $this->link
        ]);

        // When
        $this->actingAs($user)
            ->visit(route('tickets.details', $ticket))
            ->see($this->title)
            ->see('open')
            ->press('Seleccionar tutorial');

        // Then
        $this->seeInDatabase('tickets', [
            'id'        => $ticket->id, 
            'title'     => $ticket->title, 
            'status'    => 'closed', 
            'user_id'   => $user->id
        ]);

        $this->seeInDatabase('comments', [
            'comment'   => $comment->comment, 
            'link'      => $comment->link, 
            'selected'  => true, 
        ]);

        $this->seePageIs(route('tickets.details', $ticket));

        $this->seeLink('Ver recurso', $this->link);

    }
}
