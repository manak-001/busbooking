@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<div class="row">
    <h4 class="fw-bold py-3 mb-4">Vehicles <a href="{{route('admin.vehicles-create')}}" class="btn btn-primary float-end">Add New</a> </h4>
    <div class="card mt-5">
        <div class="card-title">

        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover" id="listingTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>Reg NO </th>
                            <th>Engine NO </th>
                            <th>Chasis NO</th>
                            <th>Model No</th>
                            <th>Fleet Type</th>
                            <th>Status</th>
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
                [8, "desc"]
            ],
            "ajax": {
                "url": "{{route('admin.vehicles-list')}}",
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
                    "data": "reg_no"
                },
                {
                    "data": "engine_no"
                },
                {
                    "data": "chasis_no"
                },
                {
                    "data": "model_no"
                },
                {
                    "data": "fllet_type"
                },
                {
                    "data": "status"
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
                "targets": [0, 2, 3, 4, 5, 6, 7, 9] /* column index */
                /* true or false */
            }],
        });
    }
</script>
<script>
    $("body").on("change", ".statusSwitcher", function() {
        var id = $(this).data('value');
        $.ajax(
            {
                url: "{{route('admin.vehicles-status')}}",
                dataType: "json",
                type: "get",
                data:{
                    id:id,
              },
              success: function(data) {
                        if (data.status == 1) {
                            listingTable();
                            successMsg(data.msg);
                        } else {
                            errorMsg(data.msg);
                        }
                    }
            }
        );
    });
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
                    "url": "{{route('admin.vehicles-delete')}}",
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