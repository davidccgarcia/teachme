@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('partials.success')

                <h2 class="title-show">
                    {{ $ticket->title }}
                    @include('tickets.partials.status', $ticket)
                </h2>

                @if ($ticket->link)
                    <p>
                        <a href="{{ $ticket->link }}" class="btn btn-primary" rel="nofollow" target="_blank">
                            Ver recurso
                        </a>
                    </p>
                @endif
                <h4 class="label label-info news">
                    {{ $ticket->voters()->count() }} votos
                </h4>

                <p class="vote-users">
                    @foreach ($ticket->voters as $voter)
                        <span class="label label-info">{{ $voter->name }}</span>
                    @endforeach
                </p>
                
                @if (currentUser()->hasVoted($ticket))
                    {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'POST']) !!}
                        <button type="submit" class="btn btn-hight">
                            <span class="glyphicon glyphicon-thumbs-down"></span> 
                            No votar
                        </button>
                    {!! Form::close() !!}
                @else 
                    {!! Form::open(['route' => ['tickets.submit', $ticket->id], 'method' => 'POST']) !!}
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-thumbs-up"></span> 
                            Votar
                        </button>
                    {!! Form::close() !!}
                @endif
                <br><br>
                @include('partials.errors')

                <h3>Nuevo Comentario</h3>
                
                {!! Form::open(['route' => ['comments.submit', $ticket->id], 'method' => 'POST']) !!}
                    <div class="form-group">
                        <label for="comment">Comentarios:</label>
                        <textarea rows="4" class="form-control" name="comment" cols="50" id="comment">
                            
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Enlace:</label>
                        <input class="form-control" name="link" type="text" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar comentario</button>
                {!! Form::close() !!}

                <h3>Comentarios ({{ $ticket->comments->count() }})</h3>
                
                @foreach ($ticket->comments as $comment)
                    <div class="well well-sm">
                        <p><strong>{{ $comment->user->name }}</strong></p>
                        <p>
                            {{ $comment->comment }}
                        </p>
                        <p class="date-t">
                            <span class="glyphicon glyphicon-time"></span> 
                            {{ $comment->created_at->format('d/m/Y h:ia') }}

                            @if ($comment->link)
                                <a href="{{ $comment->link }}" target="_blank" rel="nolink">{{ $comment->link }}</a>
                                
                                @can('selectResource', $ticket)
                                    {!! Form::open(['route' => ['tickets.select', $ticket, $comment]]) !!}
                                        <button type="submit" class="btn btn-success">Seleccionar tutorial</button>
                                    {!! Form::close() !!}
                                @endcan
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection()