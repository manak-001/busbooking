@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')

<div class="card row">
    <div class="card-header">
        <div class="card-title">
            <h4 €class="fw-bold py-3 mb-4">Add Schedule<a href="{{route('admin.schedule')}}" class="btn btn-dark float-end">Back</a>
        </div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.schedule-save')}}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for=""> Start From *</label>
                        <input type="time" name="start_from" class="form-control  @error('start_from') is-invalid @enderror">
                        @error('start_from')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">End At</label>
                        <input type="time" name="end_at" class="form-control  @error('end_at') is-invalid @enderror">
                        @error('end_at')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Duaration *</label>
                        <input type="text" name="duration" class="form-control  @error('duration') is-invalid @enderror">
                        @error('duration')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="">Satus*</label>
                        <select class="form-control classwisesection" name="status">
                            <option value="" selected>Status</option>
                            <option value="0">Active</option>
                            <option value="1">Reject</option>
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