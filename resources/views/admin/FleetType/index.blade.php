@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
<h4 class="fw-bold py-3 mb-4">Seat Layout <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary float-end">Add New</a>
</h4>
@include('layouts.message')
<div class="card row">
    <div class="card-body">
        <table class="table  table-bordered" id="listingTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Layout</th>
                    <th>Total Seat</th>
                    <th>Facility</th>
                    <th>Created at</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

            </tbody>
        </table>
    </div>

</div>
</div>

<!-- ADD Model -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{route('admin.fleetType-create')}}" enctype="multipart/form-data">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Seat Layout</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class=" mb-3">
                        <label class="form-label" for="">Name *</label>
                        <input type="text" name="name" class="form-control " value="{{old('name')}}">
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="">Seat Layout *</label>
                        <select class="form-select" name="layout">
                            @foreach($seat_layout as $value)
                            <option value="{{$value->id}}">{{$value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="">No Of Desk *</label>
                        <input type="number" name="no_of_desk" class="form-control " value="{{old('no_of_desk')}}">
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="">Facilities *</label>
                        <select class="form-control facilities " name="facility[]" multiple="multiple">
                            <option value="softdrink">SoftDrink</option>
                            <option value="water-bottle">Water Bottle</option>
                            <option value="pillow">Pillow</option>
                            <option value="wifi">Wifi</option>
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="">Ac Status *</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option value="1">Yes </option>
                            <option value="2">No </option>

                        </select>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Sumit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Seat Layout -->

<div class="modal fade" id="edit_layoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="quickForm" method="post" action="{{route('admin.layout-update')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
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
                "url": "{{route('admin.fleetTypelist')}}",
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
                    "data": "layout"
                },
                {
                    "data": "total_set"
                },
                {
                    "data": "facilities"
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
                "targets": [0, 3] /* column index */
                /* true or false */
            }],
        });
    }
</script>

<script>
    $("body").on("click", ".edit_layout", function() {

        var id = $(this).data('id');
        $.ajax({
            "type": "get",
            "url": "{{route('admin.fleetType-edit')}}",
            data: {
                id: id
            },
            success: function(data) {
                if (data.status == 1) {
                    $(".data").html(data.view);
                    $("#edit_layoutModal").modal('show');
                    $("body").find(".edit_facility").select2({
                        tags: true,
                        // dropdownParent: $('#edit_layoutModal')
                    });
                   
                } else {
                    errorMsg(data.msg);
                }
            }
        });

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
                    "url": "{{route('admin.deletefleetType')}}",
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
<script>
    $('.facilities').select2({
        tags: true,
        dropdownParent: $('#myModal')
    });
</script>
@stop