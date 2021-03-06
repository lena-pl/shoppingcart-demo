@extends('layouts.master')

@section('content')
  <div class="container">

    {!! Form::open(['route' => 'auth.accept', 'class' => 'form-signin']) !!}

      <h1>Log in</h1>

      @if(count($errors) > 0)
        <div class="alert alert-danger">There were problems with your form. Please fix them.</div>
      @endif

      <div class="form-group {{ $errors->has('email') ? 'has-error text-danger' : '' }}">
        <label for="email" class="control-label">Email</label>
        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
      </div>

      <div class="form-group {{ $errors->has('password') ? 'has-error text-danger' : '' }}">
        <label for="password" class="control-label">Password</label>
        {!! Form::password('password', ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        <label>{!! Form::checkbox('remember') !!} Remember Me</label>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-ok"></span> Log in</button>
      </div>
      <div class="form-group">
        <p class="pull-right"><a href="{{ route('auth.register') }}">Register</a></p>
        <p><a href="{{ route('password.email') }}">Forgot Password?</a></p>
      </div>
    {!! Form::close() !!}
  </div>
@endsection
