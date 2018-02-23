<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use TeachMe\Repositories\TicketRepository;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use TeachMe\Entities\Ticket;

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

    public function store(Request $request, Guard $auth)
    {
        $this->validate($request, [
            'title' => 'required|max:200'
        ]);

        $ticket = $auth->user()->tickets()->create([
            'title' => $request->get('title'), 
            'status' => 'open'
        ]);

        Session::flash('success', 'Su solicitud ha sido enviada');

        return Redirect::route('tickets.details', $ticket->id);
    }
}
