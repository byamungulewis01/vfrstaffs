@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('body')
<div class="mb-5 text-center">
    <p class="mb-0 ">
      Please enter the email address associated with your account and We will email you a link to reset your password.
    </p>
  </div>
  <form method="POST" action="{{ route('sendResetLinkEmail') }}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email or Phone</label>
      <input type="text" name="emailOrPhone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email or Phone">
    </div>
    <button class="btn btn-primary w-100 py-8 mb-3">Forgot Password</button>
    <a href="{{ route('login') }}" class="btn btn-light-primary text-primary w-100 py-8">Back to Login</a>
  </form>
@endsection
