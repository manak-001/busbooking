@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="row">
    <div class="card">
        <div class="card-title">
            <div class="card-header">About Us</div>
        </div>
        <form method="post" action="{{route('admin.about-create')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <input type="hidden" name="id" value="{{$data !=null ? $data->id :""}}">
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label class="form-label" for="">Image</label>
                        <input type="file" class="form-control" name="image" id="photo">
                        @if(!null==$data)
                        <img src="{{asset('storage/'.$data->image)}}" id="imgPreview" class="mt-5" width="50%">
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label class="form-label" for=""> Heading </label>
                        <input type="text" class="form-control" name="heading" value="{{$data != null ? $data->heading:"" }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Short description *</label>
                        <textarea class="form-control" name="sort_description">{{$data != null ?$data->description :""}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$data !=null ? $data->title :""}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for=""> description *</label>
                        <textarea class="form-control summernote" name="desription">{{$data !=null ?$data->short_description :""}}</textarea>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </div>
</div>
@stop
@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $('#photo').change(function() {
        const file = this.files[0];
        console.log(file);
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                console.log(event.target.result);
                $('#imgPreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>

@stop