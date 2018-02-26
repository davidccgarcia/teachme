<?php namespace TeachMe\Http\Controllers;

use Illuminate\Http\Request;

use TeachMe\Repositories\TicketRepository;
use TeachMe\Repositories\VoteRepository;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;


class VotesController extends Controller {

    public $voteRepository;
    public $ticketRepository;

    public function __construct(
        VoteRepository $voteRepository, 
        TicketRepository $ticketRepository
    )
    {
        $this->voteRepository = $voteRepository;
        $this->ticketRepository = $ticketRepository;
    }

	public function submit(Request $request, $id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $success = $this->voteRepository->vote(currentUser(), $ticket);

        if ($request->ajax()) {
            return response()->json(['success' => $success]);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $success = $this->voteRepository->unvote(currentUser(), $ticket);
        
        if ($request->ajax()) {
            return response()->json(['success' => $success]);
        }

        return redirect()->back();
    }
}
