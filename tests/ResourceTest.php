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
            ->seePageIs(route('tickets.latest'))
            ->see('Solicitudes recientes')
            ->see($this->title)
            ->seeInDatabase('tickets', [
                'title' => $this->title, 'link' => $this->link, 'status' => 'closed'
            ]);
    }
}
