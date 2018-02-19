<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;

class TicketsController extends Controller {

	public function latest()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate(20);

        return view('tickets.list', compact('tickets'));
    }

    public function popular()
    {
        dd('popular');
    }

    public function open()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')
            ->where('status', 'open')
            ->paginate(20);

        return view('tickets.list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')
            ->where('status', 'closed')
            ->paginate(20);

        return view('tickets.list', compact('tickets'));
    }

    public function details($id)
    {
        return view('tickets.details');
    }

}
