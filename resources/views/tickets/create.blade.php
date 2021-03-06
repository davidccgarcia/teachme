@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials/errors')
                <h2>Nueva Solicitud</h2>
                
                {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Título') !!}
                        {!! Form::textarea('title', null, [
                            'rows' => 2, 
                            'class' => 'form-control', 
                            'placeholder' => 'Describe brevemente los tutoriales que Styde.net traiga para ti en 2018'
                        ]) !!}
                        {!! Form::label('link', 'Enlace') !!}
                        {!! Form::text('link', null, [
                            'class' => 'form-control', 'id' => 'link', 'placeholder' => 'https://styde.net'
                        ]) !!}
                    </div>
                    <p>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
