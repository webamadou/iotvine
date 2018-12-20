@extends('layouts.app')

@section('content')
    <div class="container contest-iotvine-url">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 image">
                <div class="text-center contest-title p-1"><strong>{{$contest->name}}</strong></div>
                <p><img src="{{$contest->images}}" class="img-responsive circle-border m-b-md" alt="profile"></p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 carousel-wrapper">
                @if($contest->end->isPast())
                    <div class="expired-contest">This contest has expired</div>
                @else
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($contest->entries as $entry)
                                <div class="carousel-item active" id="{{$entry->id}}">
                                    <div class="row pick-entry btn btn-primary btn-block p-3 mb-3" data-id="{{$contest->id}}">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">{{$entry->name}} - {{$entry->pivot->entry_link}}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div id="network-page"></div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-3">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-home" aria-selected="true">{{__('Details')}}</a>
                        <a class="nav-item nav-link" id="nav-prizes-tab" data-toggle="tab" href="#nav-prizes" role="tab" aria-controls="nav-prizes" aria-selected="false">{{__('Prizes')}}</a>
                        <a class="nav-item nav-link" id="nav-rules-tab" data-toggle="tab" href="#nav-rules" role="tab" aria-controls="nav-rules" aria-selected="false">{{__('Contact')}}</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div>{{$contest->description}}</div>
                    </div>
                    <div class="tab-pane fade" id="nav-prizes" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @forelse($contest->prizes as $prize)
                            <div class="row p-4">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">{{ucfirst($prize->name)}}</div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">{{(int)$prize->prize_value}} {{$prize->currency->name}}</div>
                            </div>
                        @empty
                            <h3>{{__('No prize were linked to this contest')}}</h3>
                        @endforelse
                    </div>
                    <div class="tab-pane fade" id="nav-rules" role="tabpanel" aria-labelledby="nav-contact-tab"><div>{{$contest->description}}</div></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="border-bottom">Contest ending in</h3>
                @if(!$contest->end->isPast())
                    <div class="contest-countdown" data-end-date="{{$contest->end}}">{{ $contest->end->format('d/m/Y') }}</div>
                @else
                    <div class="contest-countdown"> {{__('Contest had expired')}} </div>
                @endif
            </div>
        </div>
    </div>
@endsection