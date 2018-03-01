<?php

namespace TeachMe\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\User;

class TicketPolicy
{
    use HandlesAuthorization;

    public function selectResource(User $user, Ticket $ticket)
    {
        return $user->isAuthor($ticket) && $ticket->isOpen();
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
