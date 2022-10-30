@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">User <a href="{{route('admin.counter.add')}}" class="btn btn-primary float-end add_counry">Add New</a> </h4>
<div class="card mt-5">
    <div class="card-body">
        <div class="card-title">

        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered" id="listingTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>created at</th>
                        <th>action</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                </tbody>
            </table>

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
                [4, "desc"]
            ],
            "ajax": {
                "url": "{{route('admin.counter.list')}}",
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
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "phone"
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
                "targets": [0, 5] /* column index */
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
                    "url": "{{route('admin.counter.delete')}}",
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