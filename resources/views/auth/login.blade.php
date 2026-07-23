@extends('layout.master')
@section('title', 'Login')
@section('content')

<div class="d-flex justify-content-between">
  <form action="/login" method="POST" class="input-form px-5 pt-5">
    @csrf
    <div class="form-head">
      <h2>Welcome Back!</h2>
      <span>Do not have an account?</span>
      <a href="/register" class="d-inline">Register</a>
    </div>
    <div class="d-flex flex-column">
      <div class="form-group my-4">
        <label for="email">Email address:</label>
        <input type="email" class="form-control p-3" placeholder="Enter email" id="email" name="email">
      </div>
      <div class="form-group my-4">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control p-3" placeholder="Enter password" id="pwd" name="password">
      </div>
      <button type="submit" class="glass-btn my-3 mx-0">Submit</button>
    </div>

    @if ($errors->any())
      <ul class="px-4 py-2 bg-light">
        @foreach ($errors->all() as $error)
          <li class="my-2 text-danger">{{ $error }}</li>
        @endforeach
      </ul>
    @endif
  </form>
  <div class="d-flex justify-content-center align-items-center login-img">
    <img src="{{ asset('images/login.png') }}" alt="#" class="w-75">
  </div>
</div>
@stop