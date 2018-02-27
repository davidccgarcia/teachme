<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_ticket()
    {
        // Having
        $user = seed('User');

        // When
        $this->actingAs($user)
            ->visit(route('tickets.latest'));

        // Then
        $this->click('Nueva solicitud')
            ->seePageIs(route('tickets.request'))
            ->type('Curso de Vue Js', 'title')
            ->press('Enviar Solicitud')
            ->see('Curso de Vue Js')
            ->seeInDatabase('tickets', ['title' => 'Curso de Vue Js']);
    }
}
