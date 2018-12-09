<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
        {!! Form::label('Name') !!}
        {!! Form::text('name', null, ['placeholder'=>'Contest name', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
        {!! Form::label('Start of contest') !!}
        {!! Form::date('start', \Carbon\Carbon::parse($contest->start),['class'=>'form-control'] ) !!}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
        {!! Form::label('End of contest') !!}
        {{--{!! Form::input('datetime-local', 'end',$contest->end, ['class' => 'form-control']) !!}--}}
        {!! Form::date('end', \Carbon\Carbon::parse($contest->end),['class'=>'form-control'] ) !!}
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
        {!! Form::label('Description') !!}
        {!! Form::textarea('description', null, ['placeholder'=>'Contest name', 'class'=>'form-control']) !!}
    </div>
</div>