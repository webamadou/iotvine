 @extends('layouts.app')

@section('content')
    <div id="app" class="container">
        {!! Form::open(['id'=>'addNewPrize']) !!}
        <input type="hidden" name="user_id" value="{{$user->id}}">
            <h5 class="text-center m-4">{{__('Add a new prize')}}</h5>
        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#add-prizes" aria-controls="add-prizes">ADD A PRIZE</button>
            @php $show = count($contest->prizes) <= 0?'show':'' @endphp
            <div class="row collapse pt-2 pb-2" id="add-prizes">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                {{__('Prize Name')}}
                            </div>
                        </div>
                        <input type="text" name="name" class="form-control" aria-label="Text input with checkbox">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{__('Description')}}
                        </div>
                    </div>
                    <textarea name="description" class="form-control" placeholder="{{__('Add a quick description to the prize')}}"></textarea>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{__('Prize type')}}
                        </div>
                    </div>
                    <select name="type" class="form-control" placeholder="{{__('Prize type')}}">
                        <option value=""> --- </option>
                        <option value="1">{{__('electronic')}}</option>
                        <option value="2">{{__('Physique')}}</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{__('Prize value')}}
                        </div>
                    </div>
                    <input type="text" value="" name="prize_value" placeholder="Prize value" class="form-control">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{__('Currency')}}
                        </div>
                    </div>
                    {{Form::select('currency_id',$currencies,2,['placeholder'=>'Select a currency','class'=>'form-control'])}}
                </div>
                <div class="col-xs-12 col-sm-12 mt-5">
                    <button type="button" id="add_prize" class="btn btn-primary btn-block">Add a prize</button>
                </div>
            </div>
            <h5 class="text-center m-4"> -{{__('Or pick  an existing one')}} -</h5>
        {!!Form::close()!!}
        {!! Form::model($contest, ['route' => ['edit_contest','slug'=>$contest->slug],'id'=>'thirdPageUpdate']) !!}
            {!! Form::hidden('step','one') !!}
            {!! Form::hidden('id',null) !!}
            <div class="row" id="list-prizes">
                @forelse($prizes as $prize)
                    @php $selected = @$prize->contests->contains($contest->id)?'checked':'' @endphp
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 prize-line row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <input type="checkbox" name="prizes[]" value="{{$prize->id}}" id="{{$prize->id}}" aria-label="Checkbox for following text input" {{$selected}}>
                        </div>
                        <label class="col-xs-10 col-sm-10 col-md-10 col-lg-10" for="{{$prize->id}}">{{$prize->name}}</label>
                    </div>
                @empty
                    <h3 class="aligncenter">{{__("You haven't created any prize yet")}}</h3>
                @endforelse
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a href="{{route('editPageTwo',['slug'=>$contest->slug])}}" class="btn btn-success btn-block"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <button class="btn btn-primary btn-block" id="submit_page_three_update">{{__('Continue')}} <i class="fa fa-arrow-right"></i></button>
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
        $('body').on('click','#add_prize',function(e){//When submitting the form to add a prize
            e.preventDefault();
            let form_data = $('#addNewPrize').serialize();
            $.ajax({
                type:'POST',
                url:"{{ url('/storePrize')}}",
                data: form_data,
                success:function(data){
                    toastr.success(`Prize saved`);
                    let prize = data.data ;
                    let prize_line = `<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 prize-line row"><div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input type="checkbox" name="prizes[]" value="${prize.id}" id="${prize.id}" aria-label="Checkbox for following text input"></div> <label for="31" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">${prize.name}</label></div>`;
                    $('#add-prizes').removeClass('show');
                    $('#add-prizes input').each(function (e) {
                        $(this).val('');
                    });
                    $('#list-prizes').prepend(prize_line) ;
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
        $('body').on("click","#submit_page_three_update",function(e){
            e.preventDefault();

            $.ajax({
                type:'POST',
                url:"{{ url('/contestUpdaterPageThree')}}",
                data: $('#thirdPageUpdate').serialize(),
                success:function(data){
                    if (data.response === 'SUCCESS') {
                        window.location.href = `{{url('/')}}`;
                    } else {
                        toastr.error(`<p>${data.messages[0]}</p>`);
                    }
                },
                error: function (request, status, error) {
                    json = $.parseJSON(request.responseText);
                    toastr.error(json.message);
                    $.each(json.errors, function(key, value){
                        toastr.error('<p>'+value+'</p>');
                    });
                    $("#errors").html('');
                }
            });
        });
    </script>
@endsection
