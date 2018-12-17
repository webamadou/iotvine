@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 contest-image p-0">
                <div class="row m-0">
                    <div class="col-xs-12"><img src="{{$contest->images}}" class="img-circle circle-border m-b-md" alt="profile"></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 contest-date-start">
                        <div class="contest-start">{{ $contest->start->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 contest-date-end">
                        <div class="contest-end">{{ $contest->end->format('d/m/Y') }}</div>
                    </div>
                    <div class="hidden-xs col-sm-12 col-md-12 col-lg-12 countdown p-0">
                        @if(!$contest->end->isPast())
                            <div class="contest-countdown" data-end-date="{{$contest->end}}">{{ $contest->end->format('d/m/Y') }}</div>
                        @else
                            <div class="contest-countdown"> {{__('Contest had expired')}} </div>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0 mt-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="embed-tab" data-toggle="tab" href="#embed" role="tab" aria-controls="home" aria-selected="true">{{__('Embed')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="share-tab" data-toggle="tab" href="#share" role="tab" aria-controls="profile" aria-selected="false">{{__('Share')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="embed" role="tabpanel" aria-labelledby="embed-tab">
                                <div class="input-group ">
                                    <textarea class="form-control embed_box main_embed_box" id="embed_code" readonly="" rows="4"><a href="{{route('contest_url', ['slug' => $contest->slug])}}" target='_blank' class='contest-iotvine' data-contest-key='{{$contest->url}}'>Contest by IOTVINE.</a><script src="https://cdn.rewardsfuel.com/embed_2.js"></script></textarea>
                                    <span class="input-group-btn"><button class="btn btn-block btn-success copy_button embed_box_button" id="main-copy-button" data-clipboard-target="#embed_code">Copy <i class="fa fa-code"></i></button></span>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="share" role="tabpanel" aria-labelledby="share-tab">
                                <div class="input-group">
                                    <span class="input-group-addon">URL:</span>
                                    <input type="text" class="form-control contest_url" placeholder="url" value="{{route('contest_url', ['slug' => $contest->slug])}}" readonly="" style="background-color: #fff; color:#222; text-align: center;">
                                    <span class="input-group-addon copy_button" id="url_label"><a href="{{route('contest_url', ['slug' => $contest->slug])}}" class="copy_button" target="_blank">Visit</a></span><button class="btn btn-block btn-success copy_button embed_box_button" id="main-copy-button" data-clipboard-target="#embed_code">Copy <i class="fa fa-code"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                <div class="col-xs-12 col-md-12 contest-title p-0"><h3>{{$contest->name}}</h3></div>
                <div class="col-xs-12 contest-description"><b>Description</b><br/> {{$contest->description}}</div>
            </div>
        </div>
        <div class="row contest-entries-prize">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 contest-entries">
                <h3>{{__('Contest Entries')}}</h3>
                <ul class="list-group list-group-flush">
                    @forelse($contest->entries as $entry)
                        <li class="col-xs-12"><b>{{$entry->name}}
                                : {{$entry->entry_prefix}}{{@$entry->pivot->entry_link}}</b></li>
                    @empty
                        <h3 class="aligncenter water-mark">{{__('No entry is linked to this contest')}}</h3>
                    @endforelse
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 contest-prize">
                <h3>{{__('Contest Prizes')}}</h3>
                <ul class="list-group list-group-flush">
                    @forelse($contest->prizes as $prize)
                        <li class="col-xs-12"><b>{{$prize->name}}</b></li>
                    @empty
                        <h3 class="aligncenter water-mark">{{__('No prize is linked to this contest')}}</h3>
                    @endforelse
                </ul>
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