<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;
use TeachMe\Entities\User;

class TicketRepository extends BaseRepository
{
    private function getCountVotesQuery()
    {
        return '(SELECT COUNT(*) FROM votes WHERE votes.ticket_id = tickets.id)';
    }

    private function getCountCommentsQuery()
    {
        return '(SELECT COUNT(*) FROM comments WHERE comments.ticket_id = tickets.id)';
    }

    public function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
            'tickets.*, '
            . $this->getCountVotesQuery() . ' as num_votes,'
            . $this->getCountCommentsQuery() . ' as num_comments'
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

    public function paginatePopular()
    {
        return $this->selectTicketList()
            ->orderBy('num_votes', 'DESC')
            ->whereRaw($this->getCountVotesQuery() . '>=10')
            ->paginate(20);
    }

    public function openNew(User $user, $title, $link)
    {
        return $user->tickets()->create([
            'title' => $title, 
            'link' => $link,
            'status' => empty($link) ? 'open' : 'closed', 
        ]);
    }
}
