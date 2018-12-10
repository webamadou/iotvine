@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <div class="text-center"><strong>Contest {{ $contest->name }} settings</strong></div>
        {!! Form::model($contest, ['route' => ['edit_contest','slug'=>$contest->slug],'id'=>'firstPageUpdate']) !!}
            {!! Form::hidden('step','one') !!}
            {!! Form::hidden('id',null) !!}
            @include('contests/_form')
            <div class="row justify-content-center mb-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" id="submit_page_one_update" class="btn btn-primary btn-lg btn-block">
                        <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> Update
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
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
                url:"{{ url('/contestUpdaterPageOne') }}",
                data: $('#firstPageUpdate').serialize(),
                success:function(data){
                    let url = `{{ url('/contestUpdaterPageTwo') }}/${data.data.slug}`;
                    window.location.href = url;
                },
                error: function (request, status, error) {
                    json = $.parseJSON(request.responseText);
                    $.each(json.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                    });
                    $("#errors").html('');
                }
            });
        });
    </script>
@endsection
