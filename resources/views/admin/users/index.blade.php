@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="row">
    <h4 class="fw-bold py-3 mb-4">Users <a href="{{route('admin.users-create')}}" class="btn btn-primary float-end">Add New</a> </h4>
    <div class="card mt-5">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover" id="listingTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>Phone </th>
                            <th>email </th>
                            <th>Country</th>
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
                [1, "desc"]
            ],
            "ajax": {
                "url": "{{route('admin.users-list')}}",
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
                    "data": "phone"
                },
                {
                    "data": "email"
                },
                {
                    "data": "country"
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
                "targets": [0, 4, 6] /* column index */
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
                    "url": "{{route('admin.users.delete')}}",
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