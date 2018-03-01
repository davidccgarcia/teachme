<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $this->assertTrue($policy->selectResource($admin, $ticket));
    }
}
