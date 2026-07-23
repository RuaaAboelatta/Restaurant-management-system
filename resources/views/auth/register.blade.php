@extends('layout.master')
@section('title', 'Register')
@section('content')

<div class="d-flex justify-content-between">
  <form action="/register" method="POST" class="input-form px-5 pt-5">
    @csrf
    <div class="form-head">
      <h2>Welcome!</h2>
      <span>Already have an account?</span>
      <a href="/login" class="d-inline">Login</a>
    </div>
    <div class="d-flex flex-column">
      <div class="form-group my-3">
        <label for="name">Name:</label>
        <input type="text" class="form-control p-3" placeholder="Enter name" id="name" name="name">
      </div>
      <div class="form-group my-3">
        <label for="email">Email address:</label>
        <input type="email" class="form-control p-3" placeholder="Enter email" id="email" name="email">
      </div>
      <div class="form-group my-3">
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