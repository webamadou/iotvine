@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center"><strong>FILL THE FORM TO CREATE A CONTEST</strong></div>
        {!! Form::model($contest, ['id' => 'firstPageUpdate','files' => true,'action'=>'ContestController@updatePageOne']) !!}
        @include('contests/_form')
        <div class="row justify-content-center mb-5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {!! Form::label(__('Contest Image')) !!}
                <input type="file" class="form-control" name="images" multiple />
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" id="submit_page_one_update" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> Update
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function validate(formData, jqForm, options) {
            var form = jqForm[0];
            if (!form.images.value) {
                toastr.error(`{{__('File not found')}}`);
                return false;
            }
        }
        (function() {
            var bar     = $('.bar');
            var percent = $('.percent');
            var status  = $('#status');

            $('form').ajaxForm({
                //beforeSubmit: validate,
                beforeSend: function() {
                    status.empty();
                    var percentVal  = '0%';
                    var posterValue = $('input[name=file]').val();
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                success: function(data) {
                    var percentVal = `{{__('Wait, Saving')}}`;
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                error: function (request, status, error) {
                    json = $.parseJSON(request.responseText);
                    $.each(json.errors, function(key, value){
                        toastr.error('<p>'+value+'</p>');
                    });
                    $("#errors").html('');
                },
                complete: function(xhr) {
                    status.html(xhr.responseText);
                    let data = xhr.responseText;
                    let jsonResponse = JSON.parse(data);
                    //console.log(jsonResponse.data.name);
                    if (jsonResponse.response === 'SUCCESS') {
                        toastr.success(`{{__('Uploaded Successfully')}} ${status.html(xhr.responseText.response)}`);
                        let url = `{{ url('/contestUpdaterPageTwo') }}/${jsonResponse.data.slug}`;
                        window.location.href = url;
                    } else {
                        toastr.error(`<div class="alert alert-danger">{{__('Error while processing')}}</div>`);
                    }
                }
            });
        })();
    </script>
@endsection