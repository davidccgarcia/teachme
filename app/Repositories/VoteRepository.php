<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;
use TeachMe\Entities\User;

class VoteRepository
{
    public function vote(User $user, Ticket $ticket)
    {
        return $user->vote($ticket);
    }
}
