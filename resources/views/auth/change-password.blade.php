@extends('layouts.auth')
@section('title', 'Change Password')
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
      <label for="exampleInputEmail1" class="form-label">New Password</label>
      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="Enter Username">
    </div>
    <div class="mb-4">
      <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="*************">
    </div>
    <button class="btn btn-primary w-100 py-8 mb-4 rounded-2">Change Password</button>

</form>
@endsection
