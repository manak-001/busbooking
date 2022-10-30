@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<div class="pagetitle">
    <h1>Form Layouts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Layouts</li>
        </ol>
    </nav>
</div>
@include('layouts.message')
<div class="card">
    <div class="card-header">
        <div class="card-title">Add User
        <a href="{{route('admin.bookinghistory')}}" class="btn btn-dark float-end add_counry">Back</a>
        </div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.bookinghistory-save')}}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for=""> Name *</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> PNR NuMBER *</label>
                        <input type="text" name="Pnrnumber" class="form-control  @error('Pnrnumber') is-invalid @enderror" value="{{old('Pnrnumber')}}">
                        @error('Pnrnumber')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Jourany Date *</label>
                        <input type="date" name="Jourany_date" class="form-control  @error('Jourany_date') is-invalid @enderror" value="{{old('Jourany_date')}}">
                        @error('Jourany_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Trip *</label>
                        <input type="text" name="trip" class="form-control  @error('trip') is-invalid @enderror" value="{{old('phone')}}">
                        @error('trip')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                    <label class="form-label" for="">PickUp Point *</label>
                        <input type="text" name="pickuppoint" class="form-control  @error('pickuppoint') is-invalid @enderror" value="{{old('pickuppoint')}}">
                        @error('pickuppoint')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Dropping Point*</label>
                        <input type="text" name="dropping_point" class="form-control @error('dropping_point') is-invalid @enderror" value="{{old('dropping_point')}}">
                        @error('dropping_point')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="">Status</label>
                        <select class="form-select" aria-label="Default select example" name="season">
                                <option selected>Satus</option>
                                <option value="1" >Pending</option>
                                <option value="2" >BookedTicket</option>
                                <option value="3" >Reject Ticket</option>
                                <option value="4" >All Ticket</option>
                            </select>
                    </div>
                    <div class="col-md-6 mb-3">
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