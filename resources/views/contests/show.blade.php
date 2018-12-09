@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-2">
                <p><img src="{{$contest->images}}" class="img-circle circle-border m-b-md" alt="profile"></p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                <h3>{{$contest->name}}</h3>
                <div class="col-xs-12 description">{{$contest->description}}</div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">
                    <div class="contest-countdown">{{ \Carbon\Carbon::parse($contest->start)->format('d/m/Y')}}</div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">
                    <div class="contest-countdown">{{ \Carbon\Carbon::parse($contest->end)->format('d/m/Y')}}</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="contest-countdown"
                         data-end-date="{{$contest->end}}">{{ \Carbon\Carbon::parse($contest->end)->format('d/m/Y')}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                @foreach($contest->entries as $entry)
                    <div class="col-xs-12">{{$entry->name}}</div>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                @foreach($contest->prizes as $prize)
                    <div class="col-xs-12">{{$prize->name}}</div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm=12 col-md-12 col-lg-12 alignright">
                <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#exampleModal">
                    <i class="icon nalika-delete-button">Delete</i>
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        {!! Form::open(['route' => ['deletes_contest', $contest->id], 'method' => 'delete', 'class' => 'form']) !!}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Can you confirm the deletion')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('Can you confirm the deletion of the contest')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{__('Confirm deletion')}}</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection