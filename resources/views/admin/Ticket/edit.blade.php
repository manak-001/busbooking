@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')

<div class="card row">
    <div class="card-header">
        <div class="card-title">
            <h4 €class="fw-bold py-3 mb-4">Edit Ticket<a href="{{route('admin.ticket')}}" class="btn btn-dark float-end">Back</a>
        </div>
        <div class="card-body">
            <form id="" method="post" action="{{route('admin.ticket-update')}}">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for=""> Fleet Type *</label>
                        <select class="form-control  " name="fleet_type">
                            @foreach($fleet_type as $type)
                            <option value="{{$type->id}}" {{$data->feet_type==$type->id ?"selected" :""}}selected>{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('fleet_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Route</label>
                        <select class="form-control  " name="route">
                            @foreach($route as $routes)
                            <option value="{{$routes->id}}" {{$data->route==$routes->id ? "selected" :""}}>{{$routes->name}}</option>
                            @endforeach
                        </select>
                        @error('route')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Price *</label>
                        <input type="text" name="price" class="form-control  @error('price') is-invalid @enderror" value="{{$data->price}}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">

                    </div>


                    <div class="col-md-3 mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@stop