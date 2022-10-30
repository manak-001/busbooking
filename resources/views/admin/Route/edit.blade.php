@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')

<div class="card row">
    <div class="card-header">
        <div class="card-title">
            <h4 class="fw-bold py-3 mb-4">Edit Route<a href="{{route('admin.route')}}" class="btn btn-dark float-end">Back</a>
        </div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.route-update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$data->name}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Starting Point</label>
                        <input type="text" name="starting_point" class="form-control  @error('starting_point') is-invalid @enderror" value="{{$data->starting_point}}">
                        @error('starting_point')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Ending Point *</label>
                        <input type="text" name="ending_pooint" class="form-control  @error('ending_pooint') is-invalid @enderror" value="{{$data->ending_point}}">
                        @error('ending_pooint')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Distance *</label>
                        <input type="number" name="distance" class="form-control  @error('distance') is-invalid @enderror" value="{{$data->distance}}">
                        @error('distance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Satus*</label>
                        <select class="form-control classwisesection" name="status">
                            <option value="" selected>Status</option>
                            <option value="0" {{$data->status==0 ?"selected" :""}}>Active</option>
                            <option value="1" {{$data->status==1 ?"selected" :""}}>Reject</option>
                        </select>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Time*</label>
                        <input type="time" name="time" class="form-control @error('time') is-invalid @enderror" value="{{date('H:i:s',strTotime($data->time))}}">
                        @error('time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop