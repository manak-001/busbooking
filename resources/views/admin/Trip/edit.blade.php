@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')

<div class="card row">
    <div class="card-header">
        <div class="card-title">
            <h4 €class="fw-bold py-3 mb-4">Edit Trip<a href="{{route('admin.ticket')}}" class="btn btn-dark float-end">Back</a>
        </div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.trip-update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for=""> Title*</label>
                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{$data->title}}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Type</label>
                        <input type="text" name="type" class="form-control  @error('type') is-invalid @enderror" value="{{$data->type}}">
                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Day *</label>
                        <input type="week" name="day" class="form-control  @error('day') is-invalid @enderror" value="{{$data->day}}">
                        @error('day')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Status</label>
                        <select class="form-control  " name="status">
                            <option value="0" {{$data->status='0' ?"selected" :""}}>Active</option>
                            <option value="1" {{$data->status='1' ?"selected" :""}}>Reject</option>
                        </select>
                        @error('status')
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