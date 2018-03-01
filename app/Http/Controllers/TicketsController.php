<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use TeachMe\Repositories\TicketRepository;

class TicketsController extends Controller {

    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

	public function latest()
    {
        $tickets = $this->ticketRepository->paginateLatest();

        return view('tickets.list', compact('tickets'));
    }

    public function popular()
    {
        dd('popular');
    }

    public function open()
    {
        $tickets = $this->ticketRepository->paginateOpen();

        return view('tickets.list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = $this->ticketRepository->paginateClosed();

        return view('tickets.list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);

        return view('tickets.details', compact('ticket'));
    }

    public function request()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200', 
            'link'  => 'url'
        ]);

        $ticket = $this->ticketRepository->openNew(
            currentUser(), $request->get('title'), $request->get('link')
        );

        Session::flash('success', 'Su solicitud ha sido enviada');

        return Redirect::route('tickets.details', $ticket->id);
    }

    public function select($ticket, $comment)
    {
        $ticket = $this->ticketRepository->findOrFail($ticket);
        $this->authorize('selectResource', $ticket);

        $ticket->assignResource($comment);

        return Redirect::back();
    }
}
