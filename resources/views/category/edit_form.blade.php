<div class="form-group {{ $errors->has('category_name') ? 'has-error' : ''}}">
    {!! Form::label('category_name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('category_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="select" class="col-lg-4 control-label">Vendor</label>
    <div class="col-md-4">
      <select class="form-control" id="vendor_id" name="vendor_id" required="required">
        @if($category->vendor_id){
                <option selected value="<?php echo $category->vendor_id; ?>"><?php echo $category->vendor_name; ?></option>
        }
        @endif
        <option value=""> --Select-- </option> 
      <?php foreach ( $vendors as $key => $v ): ?>
                <option value="<?php echo $key; ?>"><?php echo $v; ?></option>
              <?php endforeach; ?>
      </select>
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
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
