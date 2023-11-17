@extends('layouts.auth')
@section('title', 'Login')
@section('body')
<form action="{{ route('login.post') }}" method="POST">
    @csrf
    @if($errors->any())
    <div class="alert customize-alert alert-dismissible alert-light-warning text-warning fade show remove-close-icon" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="font-medium me-3 me-md-0">
          @foreach ($errors->all() as $error)
            <li>* {{ $error }}</li>
            @endforeach
        </div>
      </div>
      @endif
    @if(session()->has('error'))
    <div class="alert customize-alert alert-dismissible alert-light-warning text-warning fade show remove-close-icon" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="font-medium me-3 me-md-0">
            {{ session()->get('error') }}
        </div>
      </div>
      @endif

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="Enter Username">
    </div>
    <div class="mb-4">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="*************">
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
      <div class="form-check">
        <input class="form-check-input danger" type="checkbox" value="" id="flexCheckChecked" checked>
        <label class="form-check-label text-dark" for="flexCheckChecked">
          Remeber this Device
        </label>
      </div>
      <a class="text-dark fw-medium" href="{{ route('forgotPassword') }}">Forgot Password ?</a>
    </div>
    <button class="btn btn-danger w-100 py-8 mb-4 rounded-2">Sign In</button>

</form>
@endsection
