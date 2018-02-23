<div data-id="25" class="well well-sm request">
    <h4 class="list-title">
        {{ $ticket->title }}
        @include('tickets.partials.status', $ticket)
    </h4>
    <p>
        {!! Form::open(['route' => ['tickets.submit', $ticket], 'method' => 'POST']) !!}
            <button type="submit" class="btn btn-primary btn-vote">
                <span class="glyphicon glyphicon-thumbs-up"></span> 
                Votar
            </button>
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['tickets.destroy', $ticket], 'method' => 'POST']) !!}
            <button type="submit" class="btn btn-hight btn-unvote hide">
                <span class="glyphicon glyphicon-thumbs-down"></span> 
                No votar
            </button>
        {!! Form::close() !!}

        <a href="{{ route('tickets.details', $ticket) }}">
            <span class="votes-count">{{ $ticket->num_votes }} votos</span>
            - <span class="comments-count">{{ $ticket->num_comments }} comentarios</span>.
        </a>

    <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{ $ticket->created_at->format('d/m/Y h:ia') }}</p>
    </p>
</div>