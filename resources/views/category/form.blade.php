<div class="form-group {{ $errors->has('category_name') ? 'has-error' : ''}}">
    {!! Form::label('category_name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('category_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category_avatar') ? 'has-error' : ''}}">
    {!! Form::label('category_avatar', 'Avatar', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('category_avatar', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('category_avatar', '<p class="help-block">:message</p>') !!}
    </div>
</div>
  	
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
