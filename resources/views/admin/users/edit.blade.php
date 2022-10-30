@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<div class="card row">
    <div class="card-header">
        <div class="card-title">Edit User</div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.users.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}" >
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$data->name}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Email *</label>
                        <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{$data->email}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="col-md-6">
                        <label class="form-label" for=""> Phone *</label>
                        <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{$data->phone}}">
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Country *</label>
                        <select class="form-control classwisesection" name="country">
                            <option value="" selected>Select Country</option>
                            @foreach($country as $key=>$vlaue)
                            <option value="{{$vlaue->id}}" {{$data->country_id==$vlaue->id ?"selected" :""}} >{{$vlaue->name}}</option>
                            @endforeach
                        </select>
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Join At*</label>
                        <input type="date" name="join_at" class="form-control @error('join_at') is-invalid @enderror" value="{{$data->join_at}}">
                        @error('join_at')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-3 mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@stop