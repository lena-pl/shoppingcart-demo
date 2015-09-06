@extends('layouts.master')

@section('content')
  <div class="container">
    <h1>Edit Your Profile</h1>

    {!! Form::open(['route' => ['profile.update'], 'class' => 'form-horizontal', 'method' => 'PUT']) !!}

      @if(count($errors) > 0)
        <div class="alert alert-danger">There were problems with your form. Please fix them.</div>
      @endif

      <div class="form-group required {{ $errors->has('name') ? 'has-error text-danger' : '' }}">
        <label for="name" class="col-sm-2 control-label">Full name</label>
        <div class="col-sm-10">
          {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
          @include('partials.error-help-block', ['field' => 'name'])
        </div>
      </div>

      <div class="form-group required {{ $errors->has('email') ? 'has-error text-danger' : '' }}">
        <label for="email" class="col-sm-2 control-label">Email Address</label>
        <div class="col-sm-10">
          {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
          @include('partials.error-help-block', ['field' => 'email'])
        </div>
      </div>

      <div class="form-group {{ $errors->has('password') ? 'has-error text-danger' : '' }}">
        <label for="password" class="col-sm-2 control-label">New Password</label>
        <div class="col-sm-10">
          {!! Form::password('password', ['class' => 'form-control']) !!}
          @include('partials.error-help-block', ['field' => 'password'])
        </div>
      </div>
      <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error text-danger' : '' }}">
        <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
        <div class="col-sm-10">
          {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
          @include('partials.error-help-block', ['field' => 'password_confirmation'])
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="help-block">Leave passwords blank to keep your existing password.</div>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Update Profile</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
@endsection
