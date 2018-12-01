@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <h3>CONTEST {{ $contest->name }} SETTINGS</h3>
        {!! Form::model($contest, ['route' => ['edit_contest','slug'=>$contest->slug],'id'=>'firstPageUpdate']) !!}
            {!! Form::hidden('step','one') !!}
            {!! Form::hidden('id',null) !!}
            @include('contests/_form')
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
