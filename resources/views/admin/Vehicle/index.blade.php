@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">Vehicle<a href="{{route('admin.vehicle-create')}}" class="btn btn-primary float-end">Add New</a>
</h4>
<div class="card row">
    <div class="card-title">
 </div>
    <div class="card-body">
        <table class="table  table-bordered" id="listingTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Trip</th>
                    <th>Name</th>
                    <th>Reg no</th>
                    <th>Created at</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

            </tbody>
        </table>
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
                [3, "desc"]
            ],
            "ajax": {
                "url": "{{route('admin.trip-list')}}",
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
                    "data": "trip"
                },
                {
                    "data": "name"
                },
                {
                    "data": "reg_no"
                },
               {
                    "data": "created_at"
                },
                {
                    "data": "action"
                },
            ],
            'columnDefs': [{
                'orderable': false,
                "targets": [0,4] /* column index */
                /* true or false */
            }],
        });
    }
</script>
<script>
    $("body").on("click", ".deleteEntry", function() {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    "type": "get",
                    "url": "{{route('admin.trip-delete')}}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            listingTable();
                            successMsg(data.msg);
                        } else {
                            errorMsg(data.msg);
                        }
                    }
                });
            }
        })

    });
</script>
@stop