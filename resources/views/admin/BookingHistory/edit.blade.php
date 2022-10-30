@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="pagetitle">
   
    <nav>
    <h4 class="fw-bold py-3 mb-4">Edit Booking Histroy <a href="{{route('admin.bookinghistory')}}" class="btn btn-dark float-end add_counry">Back</a> </h4>
    </nav>
</div>
<div class="card row">
    <div class="card-header">
    <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.bookinghistory-update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$data->user}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> PNR NuMBER *</label>
                        <input type="text" name="Pnrnumber" class="form-control  @error('Pnrnumber') is-invalid @enderror" value="{{$data->pnr_number}}">
                        @error('Pnrnumber')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Jourany Date *</label>
                        <input type="date" name="Jourany_date" class="form-control  @error('Jourany_date') is-invalid @enderror" value="{{$data->jounary_date}}">
                        @error('Jourany_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Trip *</label>
                        <input type="text" name="trip" class="form-control  @error('trip') is-invalid @enderror" value="{{$data->trip}}">
                        @error('trip')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">PickUp Point *</label>
                        <input type="text" name="pickuppoint" class="form-control  @error('pickuppoint') is-invalid @enderror" value="{{$data->pick_up_point}}">
                        @error('pickuppoint')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Dropping Point*</label>
                        <input type="text" name="dropping_point" class="form-control @error('dropping_point') is-invalid @enderror" value="{{$data->dropping_point}}">
                        @error('dropping_point')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="">Status</label>
                        <select class="form-select" aria-label="Default select example" name="season">
                            <option value="1"{{$data->status==1 ? "selected " :""}}>Pending</option>
                            <option value="2" {{$data->status==2 ? "selected " :""}}>BookedTicket</option>
                            <option value="3"  {{$data->status==3 ? "selected " :""}}>Reject Ticket</option>
                            <option value="4" {{$data->status==null ? "selected " :""}}>All Ticket</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                    </div>
                    <div class="col-md-3 mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@stop