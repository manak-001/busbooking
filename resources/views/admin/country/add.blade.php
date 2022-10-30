@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<div class="card row">
    <div class="card-header">
        <div class="card-title">Add Country</div>
        <div class="card-body">
            <form  method="post" action="{{route('admin.country-save')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="">Course Name *</label>
                        <input type="text" name="country" class="form-control  @error('country') is-invalid @enderror" value="{{old('country')}}">
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="">Currency*</label>
                        <input type="text" name="currency" class="form-control @error('currency') is-invalid @enderror" value="{{old('currency')}}">
                        @error('currency')
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