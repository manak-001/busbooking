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
    <form action="{{route('admin.contact.create')}}" method="post">
        @csrf
        <div class="card-body row">
            <div class="col-md-6">
                <label class="form-label" for="">Title *</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Short Details</label>
                <input type="text" name="details" class="form-control  @error('details') is-invalid @enderror" />
                @error('details')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Address</label>

                <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" />
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Email</label>

                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" />
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="">Contact number</label>

                <input type="number" class="form-control  @error('phone') is-invalid @enderror" name="phone" />
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