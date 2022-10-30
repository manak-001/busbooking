@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">Amenities <a href="{{route('admin.amenities')}}" class="btn btn-dark float-end">Back</a>
</h4>
<div class="card row">
    <div class="card-title">

    </div>
    <form action="{{route('admin.contact.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="card-body row">
            <div class="col-md-6">
                <label class="form-label" for="">Title *</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{$data->title}}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Short Details</label>
                <input type="text" name="details" class="form-control  @error('details') is-invalid @enderror" value="{{$data->details}}"/>
                @error('details')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Address</label>

                <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{$data->address}}"/>
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Email</label>

                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{$data->email}}"/>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Contact number</label>

                <input type="number" class="form-control  @error('phone') is-invalid @enderror" name="phone"  value="{{$data->phone}}"/>
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


        </div>
        <div class="col-md-3 mb-3 mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
</div>
@stop
@section('script')
@stop