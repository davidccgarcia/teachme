<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Gate;
use TeachMe\Policies\TicketPolicy;

class TicketPolicyTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_author_can_select_resource()
    {
        // Having
        $user = seed('User');
        $ticket = seed('Ticket', ['user_id' => $user->id]);

        // When
        $policy = new TicketPolicy();

        // Then
        $this->assertTrue($policy->selectResource($user, $ticket));
    }

    public function test_other_users_cannot_select_resource()
    {
        // Having
        $user = seed('User');
        $ticket = seed('Ticket', ['user_id' => $user->id]);

        $otherUser = seed('User');

        // When
        $policy = new TicketPolicy();

        // Then
        $this->assertFalse($policy->selectResource($otherUser, $ticket));
    }

    public function test_administrators_can_select_resource()
    {
        // Having
        $admin = seed('User', ['role' => 'admin']);
        $ticket = seed('Ticket');

        // When
        $policy = new TicketPolicy();

        // Then
        $this->assertTrue(Gate::forUser($admin)->allows('selectResource', $ticket));
    }

    public function test_prevent_users_for_selecting_resource_twice()
    {
        // Having
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id, 
            'status' => 'closed'
        ]);

        // When
        $policy = new TicketPolicy();

        // Then
        $this->assertFalse($policy->selectResource($user, $ticket));
    }

    public function test_administrators_select_two_resources()
    {
        // Having
        $user = seed('User');
        $ticket = seed('Ticket', ['user_id' => $user->id]);

        $comment1 = seed('Comment', [
            'ticket_id' => $ticket->id, 
            'link' => 'https://styde.net'
        ]);

        $comment2 = seed('Comment', [
            'ticket_id' => $ticket->id, 
            'link' => 'https://platzi.com'
        ]);

        // When
        $ticket->assignResource($comment1);
        $ticket->assignResource($comment2);

        // Then
        $this->seeInDatabase('tickets', [
            'id' => $ticket->id, 
            'link' => 'https://platzi.com', 
        ]);
        
        $this->seeInDatabase('comments', [
            'id' => $comment1->id,
            'selected' => false, 
        ]);

        $this->seeInDatabase('comments', [
            'id' => $comment2->id,
            'selected' => true, 
        ]);
    }
}
