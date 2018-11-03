@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <b>Set the entries</b>
        {!! Form::model($contest, ['route' => ['edit_contest','slug'=>$contest->slug],'id'=>'firstPageUpdate']) !!}
            {!! Form::hidden('step','one') !!}
            {!! Form::hidden('id',null) !!}
            <div class="row justify-content-center">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Name') !!}
                    {!! Form::text('name', null, ['placeholder'=>'Contest name', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xs-6 form-group">
                    {!! Form::label('Start of contest') !!}
                    {!! Form::date('start', \Carbon\Carbon::now(),['placeholder'=>'Contest name', 'class'=>'form-control'] ) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('End of contest') !!}
                    {!! Form::date('end', \Carbon\Carbon::now(),['placeholder'=>'Contest name', 'class'=>'form-control'] ) !!}
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Description') !!}
                    {!! Form::textarea('description', null, ['placeholder'=>'Contest name', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xs-12">
                    <button type="button" id="submit_page_one_update" class="btn btn-primary btn-lg btn-block">
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
            console.log('Here is the test');
            let name    = $("input[name=name]").val();
            let start   = $("input[name=start]").val();
            let end     = $("input[name=end]").val();
            let description   = $("input[name=description]").val();

            $.ajax({
                type:'POST',
                url:"{{ url('/contestUpdaterPageOne')}}",
                data: $('#firstPageUpdate').serialize(),
                success:function(data){
                    window.location.href = url{{('/contestUpdaterPageTwo')}};
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
