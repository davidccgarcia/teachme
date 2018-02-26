<div data-id="{{ $ticket->id }}" class="ticket well well-sm request">
    <h4 class="list-title">
        {{ $ticket->title }}
        @include('tickets.partials.status', $ticket)
    </h4>
    @if (Auth::check())
        <p>

            <a href="#" {!! Html::classes(['btn btn-primary btn-vote', 'hidden' => currentUser()->hasVoted($ticket)]) !!}>
                <span class="glyphicon glyphicon-thumbs-up"></span> 
                Votar
            </a>

            <a href="#" {!! Html::classes(['btn btn-hight btn-unvote', 'hidden' => ! currentUser()->hasVoted($ticket)]) !!}>
                <span class="glyphicon glyphicon-thumbs-down"></span> 
                No votar
            </a>
            
            <a href="{{ route('tickets.details', $ticket) }}">
                <span class="votes-count">{{ $ticket->num_votes }} votos</span>
                - <span class="comments-count">{{ $ticket->num_comments }} comentarios</span>.
            </a>
        <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{ $ticket->created_at->format('d/m/Y h:ia') }}</p>
    @endif
    </p>
</div>