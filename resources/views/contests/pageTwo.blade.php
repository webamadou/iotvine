 @extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <div class="text-center"><strong>Set the entries</strong></div>
        {!! Form::model($contest, ['route' => ['edit_contest','slug'=>$contest->slug],'id'=>'secondPageUpdate']) !!}
            {!! Form::hidden('step','one') !!}
            {!! Form::hidden('id',null) !!}
            <div class="row">
                @foreach($networks as $network)
                    <div class="col-lg-4 col-sm-4 networks-wrapper" data-target="network_{{$network->id}}">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-15" style="background: {{$network->color}}">
                            <h4 class="text-left text-uppercase"><b>{{ $network->name }}</b></h4>
                            <div class="col-xs-9 cus-gh-hd-pro">
                                <h2 class="text-right no-margin"><i class="fa fa-{{ $network->icon }}"></i></h2>
                            </div>
                        </div>
                    </div>
                    <div class="list-entries" id="network_{{$network->id}}">
                        @foreach($network->entries as $entry)
                            <div class="entry-link" data-id="{{$entry->id}}" style="background: {{$network->color}}">{{$entry->name}}</div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="container-fluid entry-lines">
                @foreach($contest->entries as $entry)
                    <div class="entry-line row" id="entry_{{$entry->id}}">
                        <input type="hidden" name="entry[]" value="{{$entry->id}}">
                        <input type="hidden" name="entry_{{$entry->id}}_link" value="{{$entry->pivot->entry_link}}">
                        <input type="hidden" name="entry_{{$entry->id}}_description" value="{{$entry->pivot->description}}">
                        <input type="hidden" name="entry_{{$entry->id}}_point_per_entry" value="{{$entry->pivot->point_per_entry}}">
                        <input type="hidden" name="entry_{{$entry->id}}_config" value="{{$entry->pivot->config}}">
                        <div class="col-lg-1 col-sm-1 col-xs-12"><i class="fa fa-{{$entry->network->icon}}"></i></div>
                        <div class="col-lg-9 col-sm-9 col-xs-12">{{$entry->name}}</div>
                        <div class="col-lg-1 col-sm-1 col-xs-12 edit-entry" data-id="{{$entry->id}}"><i class="fa fa-pencil"></i></div>
                        <div class="col-lg-1 col-sm-1 col-xs-12 remove-entry" data-id="{{$entry->id}}"><i class="fa fa-times"></i></div>
                    </div>
                @endforeach
            </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <a href="{{route('edit_contest',['slug'=>$contest->slug])}}" class="btn btn-success btn-block"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
            </div>
            <div class="col-xs-12 col-sm-6">
                <button class="btn btn-primary btn-block" id="submit_page_one_update">{{__('Continue')}} <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
        <div id="entries-form">
            <div class="container" id="fields-wrapper">
                <h3>{{__('Fill the form to add your entry')}}</h3>
                <div class="input-group mb-3" id="entry-link"></div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">{{__('Add a quick description')}}</span>
                    </div>
                    <textarea name="description" class="form-control" placeholder="Add a quick description"></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">{{__('Nbr Points')}}</span>
                    </div>
                    <input type="number" class="form-control" placeholder="Point per entry" name="point_per_entry">
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <button type="button" class="abort-saving btn btn-success btn-block">{{__('Cancel')}}</button>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <button type="button" class="btn btn-primary save-entry btn-block">{{__('Save entry')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on("click","#submit_page_one_update",function(e){
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:"{{ url('/contestUpdaterPageTwo')}}",
                data: $('#secondPageUpdate').serialize(),
                success:function(data){
                    if (data.response === 'SUCCESS'){
                        window.location.href = `{{url('/contestUpdaterPageThree')}}/${data.data.slug}`;
                    } else {
                        $.each(data.message, function(key, value){
                            toastr.error('<p>'+value+'</p>');
                        });
                    }
                },
                error: function (request, status, error) {
                    json = $.parseJSON(request.responseText);
                    $.each(json.errors, function(key, value){
                        toastr.error('<p>'+value+'</p>');
                    });
                    $("#errors").html('');
                }
            });
        });
    </script>
@endsection
