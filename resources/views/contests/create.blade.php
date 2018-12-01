@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>FILL THE FORM TO CREATE A CONTEST</h3>
        {!! Form::model($contest, ['id' => 'firstPageUpdate']) !!}
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
                url:"{{ url('/contestUpdaterPageOne')}}",
                data: $('#firstPageUpdate').serialize(),
                success:function(data){
                    let url = `{{ url('/contestUpdaterPageTwo') }}/${data.data.slug}`;
                    window.location.href = url;
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
