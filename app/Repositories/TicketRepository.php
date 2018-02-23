<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository
{
    public function selectTicketList()
    {
        return Ticket::selectRaw(
            'tickets.*, '
            .'(SELECT COUNT(*) FROM votes WHERE votes.ticket_id = tickets.id) as num_votes,'
            .'(SELECT COUNT(*) FROM comments WHERE comments.ticket_id = tickets.id) as num_comments'
        )->with('author');
    }
}
