@extends('layouts.app')
@section('title', 'Profile')
@section('css')
    <style>
        .upload-label {
            cursor: pointer;
        }

        .upload-label:hover {
            opacity: 0.8;
        }

        #image-upload {
            display: none;
        }
    </style>
@endsection
@section('body')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Account Setting</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="./index.html">User</a></li>
                            <li class="breadcrumb-item" aria-current="page">Account Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Personal Details</h5>
                    <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                    <form action="{{ route('changePersonalDetails') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Your Name</label>
                                    <input required type="text" class="form-control" id="exampleInputtext" name="name"
                                        value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="phone" class="form-label fw-semibold">Phone</label>
                                    <input required type="text" minlength="10" maxlength="10" class="form-control"
                                        id="phone" name="phone" value="{{ auth()->user()->phone }}">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">User Name</label>
                                    <input required type="text" class="form-control" id="exampleInputtext"
                                        name="username" value="{{ auth()->user()->username }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end gap-3">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">

                    <h5 class="card-title fw-semibold">Change Password</h5>
                    <p class="card-subtitle mb-4">To change your password please confirm here</p>
                    @if ($errors->any())
                        <div class="alert customize-alert alert-dismissible alert-light-warning text-warning fade show remove-close-icon"
                            role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="font-medium me-3 me-md-0">
                                @foreach ($errors->all() as $error)
                                    <li>* {{ $error }}</li>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert customize-alert alert-dismissible alert-light-warning text-warning fade show remove-close-icon"
                            role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="font-medium me-3 me-md-0">
                                {{ session()->get('error') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('changePassword') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Current Password</label>
                            <input type="password" name="old_password" class="form-control" id="exampleInputPassword1"
                                placeholder="**********">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword2" class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword2"
                                placeholder="**********">
                        </div>
                        <div class="">
                            <label for="exampleInputPassword3" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="exampleInputPassword3" placeholder="**********">
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')

@endsection
