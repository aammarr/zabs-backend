<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('product_description', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('product_price', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="select" class="col-lg-4 control-label">Category</label>
    <div class="col-md-4">
      <select class="form-control" id="category" name="category" required="required">
        <option value=""> --Select-- </option>
      <?php foreach ( $categories as $key => $c ): ?>
                <option value="<?php echo $key; ?>"><?php echo $c; ?></option>
              <?php endforeach; ?>
      </select>
    </div>
</div>
<div class="form-group {{ $errors->has('product_pic_1') ? 'has-error' : ''}}">
    {!! Form::label('product_pic_1', 'Picture 1', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('product_pic_1', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_pic_1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('product_pic_2') ? 'has-error' : ''}}">
    {!! Form::label('product_pic_2', 'Picture 2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('product_pic_2', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_pic_2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('product_pic_3') ? 'has-error' : ''}}">
    {!! Form::label('product_pic_3', 'Picture 3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('product_pic_3', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_pic_3', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('product_pic_4') ? 'has-error' : ''}}">
    {!! Form::label('product_pic_4', 'Picture 4', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('product_pic_4', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_pic_4', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('product_pic_5') ? 'has-error' : ''}}">
    {!! Form::label('product_pic_5', 'Picture 5', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('product_pic_5', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('product_pic_5', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
