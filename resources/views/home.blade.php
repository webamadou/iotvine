@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div> -->
            <div class="addcontestlink card" style="margin: 0 auto;">
                <div class="card-body">
                    <h5 class="card-title">Create a contest</h5>
                    <p><i class="fa fa-plus fa-3x"></i></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
