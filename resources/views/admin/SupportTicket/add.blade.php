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
        <h4 class="fw-bold py-3 mb-4">Add <a href="{{route('admin.bookinghistory')}}" class="btn btn-dark float-end add_counry">Back</a> </h4>
    </nav>
</div>
<div class="card row">
    <div class="card-header">
        <a href="" class="btn btn-danger float-end">Closet Ticket</a>
    </div>
    <div class="card-body">

        <div class="col-md-10 offset-1">
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="message"></textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="col-md-6 offset-1">
            <label class="form-label" for=""> Attachment *</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" name="attachment">
            @error('file')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    alert();
</script>
@stop