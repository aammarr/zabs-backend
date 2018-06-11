@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>
                <div class="panel-body">

                        <a href="{{ url('/admin') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/change_password', 'class' => 'form-horizontal', 'files' => true]) !!}

                            <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
                                {!! Form::label('old_password', 'Old Password', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('old_password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                           

                            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                                {!! Form::label('new_password', 'New Password', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('new_password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            
                            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                                {!! Form::label('confirm_password', 'Confirm New Password', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('confirm_password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            
                        
                            
                            <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Change Password', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
