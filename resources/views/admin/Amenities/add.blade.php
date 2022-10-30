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
    <form action="{{route('admin.amenities.create')}}" method="post">
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
                <label class="form-label" for="">Icon *</label>
                
                    <input type="text" class="form-control  @error('icon') is-invalid @enderror" name="icon" />
                    @error('icon')
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