<div data-id="25" class="well well-sm request">
    <h4 class="list-title">
        {{ $ticket->title }}
        @include('tickets.partials.status', $ticket)
    </h4>
    <p>
        {!! Form::open(['route' => ['tickets.vote', $ticket], 'method' => 'POST']) !!}
            <button type="submit" class="btn btn-primary btn-vote">
                <span class="glyphicon glyphicon-thumbs-up"></span> 
                Votar
            </button>
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['tickets.unvote', $ticket], 'method' => 'POST']) !!}
            <button type="submit" class="btn btn-hight btn-unvote hide">
                <span class="glyphicon glyphicon-thumbs-down"></span> 
                No votar
            </button>
        {!! Form::close() !!}

        <a href="{{ route('tickets.details', $ticket) }}">
            <span class="votes-count">12 votos</span>
            - <span class="comments-count">0 comentarios</span>.
        </a>

    <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{ $ticket->created_at->format('d/m/Y h:ia') }}</p>
    </p>
</div>