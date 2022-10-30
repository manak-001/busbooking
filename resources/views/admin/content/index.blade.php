@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">Content <a href="" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary float-end add_counry">Add New</a> </h4>
<div class="card mt-5">
    <div class="card-body">
        <div class="card-title">

        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered" id="listingTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>{{trns('title')}}</th>
                        <th>Values</th>
                        <th>Cerated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                </tbody>
            </table>

        </div>
    </div>
</div>
<div id="myModal" class="modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Language</h4>
            </div>
            <form action="{{route('admin.content-create')}}" post="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label class="input-control">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group mt-3">
                        <label class="input-control">Value</label>
                        <input type="text" class="form-control" name="value">
                    </div>
                    <div class="col-md-3 mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

</div>
    @stop
@section('script')

<script>
    listingTable();

    function listingTable() {
        $("#listingTable").DataTable({
            destroy: true,
            searching: true,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [2, "desc"]
            ],
            "ajax": {
                "url": "{{route('admin.content_list')}}",
                "dataType": "json",
                "type": "get",

                "dataFilter": function(data) {
                    var json = $.parseJSON(data);

                    return JSON.stringify(json);
                }
            },

            "columns": [

                {
                    "data": "id"
                },
                {
                    "data": "title"
                },
                {
                    "data": "value"
                },
                {
                    "data":"created_at"
                },
                {
                    "data":"action"
                },
            ],
            'columnDefs': [{
                'orderable': false,
                "targets": [0] /* column index */
                /* true or false */
            }],
        });
    }
</script>
<script>
    $('body').on("click", ".add_content", function() {
       $("body").closest("tr").find("<input type='text' class='form-control'");
    });
</script>
@stop