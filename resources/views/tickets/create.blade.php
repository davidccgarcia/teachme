@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0) 
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Por favor corrige los siguientes errores: <br><br>
                        <ul>
                            @foreach ($errors->all() as $error) 
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>Nueva Solictud</h2>
                
                {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Título') !!}
                        {!! Form::textarea('title', null, [
                            'rows' => 2, 
                            'class' => 'form-control', 
                            'placeholder' => 'Describe brevemente los tutoriales que Styde.net traiga para ti en 2018'
                        ]) !!}
                    </div>
                    <p>
                        <button type="submit" class="btn btn-primary">Enviar Solictud</button>
                    </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
