@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<div class="card row">
    <div class="card-header">
        <div class="card-title">Add Country</div>
        <div class="card-body">
        <form  method="post" action="{{route('admin.counter.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}" >
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('country') is-invalid @enderror" value="{{$data->name}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="">City *</label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{$data->city}}">
                        @error('city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Location *</label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{$data->location}}">
                        @error('location')
                        <div class="textdanger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Mobile *</label>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{$data->phone}}">
                        @error('mobile')
                        <div class="textdanger">{{ $message }}</div>
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