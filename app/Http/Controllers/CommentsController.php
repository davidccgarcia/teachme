<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use TeachMe\Entities\Comment;

class CommentsController extends Controller {

	public function submit(Request $request, $ticket)
    {
        $this->validate($request, [
            'comment' => 'required|max:250', 
            'link'  => 'url'
        ]);

        $comment = new Comment;
        $comment->comment = $request->get('comment');
        $comment->link = $request->get('link');
        $comment->user_id = currentUser()->id;
        $comment->ticket_id = $ticket;
        $comment->save();

        Session::flash('success', 'Su comentario ha sido enviado');

        return redirect()->back();
    }

}
