@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>FILL THE FORM TO CREATE A CONTEST</h3>
        <div class="row justify-content-center">
            {!! Form::open(['action' => 'ContestController@store']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
