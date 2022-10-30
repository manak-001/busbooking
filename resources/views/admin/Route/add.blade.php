@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')

<div class="card row">
    <div class="card-header">
        <div class="card-title">
            <h4 €class="fw-bold py-3 mb-4">Add Route<a href="{{route('admin.route')}}" class="btn btn-dark float-end">Back</a>
        </div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.route-save')}}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Starting Point</label>
                        <input type="text" name="starting_point" class="form-control  @error('starting_point') is-invalid @enderror">
                        @error('starting_point')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Ending Point *</label>
                        <input type="text" name="ending_pooint" class="form-control  @error('ending_pooint') is-invalid @enderror">
                        @error('ending_pooint')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Distance *</label>
                        <input type="number" name="distance" class="form-control  @error('distance') is-invalid @enderror">
                        @error('distance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Satus*</label>
                        <select class="form-control classwisesection" name="status">
                            <option value="" selected>Status</option>
                            <option>Active</option>
                            <option>Reject</option>
                        </select>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Time*</label>
                        <input type="time" name="time" class="form-control @error('time') is-invalid @enderror">
                        @error('time')
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