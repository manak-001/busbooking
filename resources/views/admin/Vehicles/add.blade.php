@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<div class="pagetitle">
<h1>Add Vehichle <a class="btn btn-dark float-end" href="{{route('admin.vehicles')}}">Back</a></h1>
</div>
<div class="card row">
    <div class="card-header">
        <div class="card-title"></div>
        <div class="card-body">
            <form id="quickForm" method="post" action="{{route('admin.vehicles-save')}}" enctype="multipart/form-data">
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
                        <label class="form-label" for=""> Reg NO *</label>
                        <input type="text" name="reg_no" class="form-control  @error('reg_no') is-invalid @enderror" value="{{old('reg_no')}}">
                        @error('reg_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Engine NO *</label>
                        <input type="text" name="engine_no" class="form-control  @error('engine_no') is-invalid @enderror" value="{{old('engine_no')}}">
                        @error('engine_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Chasis No *</label>
                        <input type="text" name="chasis_no" class="form-control  @error('chasis_no') is-invalid @enderror" value="{{old('chasis_no')}}">
                        @error('chasis_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Model NO *</label>
                        <input type="text" name="model_no" class="form-control  @error('model_no') is-invalid @enderror" value="{{old('model_no')}}">
                        @error('model_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> FleetType *</label>
                        <input type="text" name="type" class="form-control  @error('type') is-invalid @enderror" value="{{old('type')}}">
                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for=""> Status *</label>
                       <input class="form-check-input" type="checkbox"  name="status">
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
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