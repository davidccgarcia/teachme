<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository extends BaseRepository
{
    public function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
            'tickets.*, '
            .'(SELECT COUNT(*) FROM votes WHERE votes.ticket_id = tickets.id) as num_votes,'
            .'(SELECT COUNT(*) FROM comments WHERE comments.ticket_id = tickets.id) as num_comments'
        )->with('author');
    }

    public function getModel()
    {
        return new Ticket;
    }

    public function paginateLatest()
    {
        return $this->selectTicketList()
            ->orderBy('created_at', 'DESC')
            ->with('author')
            ->paginate(20);
    }

    public function paginateOpen()
    {
        return $this->selectTicketList()
            ->orderBy('created_at', 'DESC')
            ->where('status', 'open')
            ->paginate(20);
    }

    public function paginateClosed()
    {
        return $this->selectTicketList()
            ->orderBy('created_at', 'DESC')
            ->where('status', 'closed')
            ->paginate(20);
    }
}
