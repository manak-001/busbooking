@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
 
<div class="card row">
    <div class="card-header">
        <div class="card-title">Add User</div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.users-save')}}" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-3">
                
                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Email *</label>
                        <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Password *</label>
                        <input type="number" name="password" class="form-control  @error('password') is-invalid @enderror" value="{{old('password')}}">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Phone *</label>
                        <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{old('phone')}}">
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Country *</label>
                        <select class="form-control classwisesection" name="country">
                            <option value="" selected>Select Country</option>
                            @foreach($country as $key=>$vlaue)
                            <option value="{{$vlaue->id}}">{{$vlaue->name}}</option>
                            @endforeach
                        </select>
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Join At*</label>
                        <input type="date" name="Join_at" class="form-control @error('Join_at') is-invalid @enderror" value="{{old('Join_at')}}">
                        @error('Join_at')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="col-md-3 mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@stop