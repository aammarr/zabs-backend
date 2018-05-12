<div class="form-group {{ $errors->has('delivery_fee') ? 'has-error' : ''}}">
    {!! Form::label('Delivery Fee', 'Delivery Fee', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('delivery_fee', null, ['class' => 'form-control']) !!}
        {!! $errors->first('delivery_fee', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('Terms N Condition') ? 'has-error' : ''}}">
    {!! Form::label('Terms N Condition', 'Terms N Condition', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('t_n_c', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('t_n_c', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
