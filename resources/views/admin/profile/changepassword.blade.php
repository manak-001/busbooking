@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="col-md-6 offset-3">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card mt-5">


            <!-- <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-body fw-bolder">SMS</span>
                </a>
              </div>
              
              <h4 class="mb-2">Welcome to Sneat!</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p> -->

            <form id="quickForm" class="mb-3" action="{{route('admin.updatepassword')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="card-title"> </div>
                    <div class="mb-3">
                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                        <input name="old_password" type="password" class="form-control @error('country') is-invalid @enderror " id="oldPasswordInput" placeholder="Old Password">
                        @error('old_password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                        @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="Confirm New Password">
                        <span class="text-danger" id="new_password_confirmationError"></span>
                    </div>
                </div>


                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
        <!-- /Register -->
    </div>
</div>
@stop