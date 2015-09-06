@extends('layouts.master')

@section('content')
  <div class="container">

    {!! Form::open(['route' => 'auth.store', 'class' => 'form-signin', 'id' => 'register']) !!}

      <h1>Register New User</h1>

      @if(count($errors) > 0)
        <div class="alert alert-danger">There were problems with your form. Please fix them.</div>
      @endif

      <div class="form-group {{ $errors->has('name') ? 'has-error text-danger' : '' }}">
        <label for="name" class="control-label">Full Name</label>
        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
        @include('partials.error-help-block', ['field' => 'name'])
      </div>

      <div class="form-group {{ $errors->has('email') ? 'has-error text-danger' : '' }}">
        <label for="email" class="control-label">Email</label>
        <div class="input-group">
          {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-envelope"></span>
          </span>
        </div>
        @include('partials.error-help-block', ['field' => 'email'])
      </div>

      <div class="form-group {{ $errors->has('password') ? 'has-error text-danger' : '' }}">
        <label for="password" class="control-label">Password</label>
        {!! Form::password('password', ['class' => 'form-control']) !!}
        @include('partials.error-help-block', ['field' => 'password'])
      </div>

      <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error text-danger' : '' }}">
        <label for="password_confirmation" class="control-label">Confirm Password</label>
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        @include('partials.error-help-block', ['field' => 'password_confirmation'])
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
      </div>
      <div class="form-group">
        <p><a href="{{ route('auth.login') }}">Log in</a></p>
      </div>
    {!! Form::close() !!}
  </div>
@endsection
