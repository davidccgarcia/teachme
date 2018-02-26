@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <h1>
                        {{ $title }}
                        <a href="{{ route('tickets.request') }}" class="btn btn-primary">
                            Nueva solicitud
                        </a>
                    </h1>

                    <p class="label label-info news">
                        {{ $text_total }}
                        
                    </p>
                    @foreach ($tickets as $ticket)
                        @include('tickets.partials.item', compact('ticket'))
                    @endforeach

                    {!! $tickets->render() !!}
                <hr>
                {!! Form::open(['route' => ['tickets.submit', ':id'], 'method' => 'POST', 'id' => 'form-vote']) !!}
                {!! Form::close() !!}

                {!! Form::open(['route' => ['tickets.destroy', ':id'], 'method' => 'POST', 'id' => 'form-unvote']) !!}
                {!! Form::close() !!}

                <p><a href="http://duilio.me" target="_blank">duilio.me</a></p>

            </div>
        </div>
    </div>
@endsection()