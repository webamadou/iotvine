@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" id="app">
            <!-- <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div> -->
            <div class="breadcome-list">
                <a href="{{ route('create_contest') }}" title="add a contest" class="btn btn-primary btn-block"><i class="icon nalika-plus"></i> Add a contest</a>
            </div>
            <div class="row">
            @foreach($contests as $contest)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 contest-card">
                    <div class="personal-info-wrap">
                        <div class="widget-head-info-box">
                            <h2>{{ $contest->name }}</h2>
                            <p>{{ $contest->description }}</p>
                            <div class="contest-img"><img src="{{$contest->images}}" class="img-circle circle-border m-b-md" alt="profile"></div>
                            <div class="contest-details">
                                <div class="contest-countdown" data-end-date="{{$contest->end}}">{{ \Carbon\Carbon::parse($contest->end)->format('d/m/Y')}}</div>
                                <div class="settings-link" data-end-date="{{$contest->end}}">
                                    <a href="{{ route('edit_contest', ['slug'=>$contest->slug]) }}">
                                        <i class="icon nalika-settings"></i> Settings
                                    </a>
                                </div>
                                <div class="settings-link" data-end-date="{{$contest->end}}">
                                    <a href="{{ route('contest_show', ['slug'=>$contest->slug]) }}">
                                        <i class="icon nalika-home "></i> Show
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="widget-text-box contest-tags">
                            <ul class="text-right like-love-list">
                                <li><i class="fa fa-eye"></i> {{ $contest->nbr_views }}</li>
                                <li><i class="fa fa-users"></i> {{ $contest->nbr_contestants }}</li>
                                <li><i class="fa fa-users contest-status"></i> live </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="paginater">
            {{$contests->links()}}
        </div>
    </div>
</div>
@endsection
