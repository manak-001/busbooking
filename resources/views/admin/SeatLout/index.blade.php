@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">Seat Layout <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary float-end">Add New</a>
</h4>
<div class="card row">
    <div class="card-body">
        <table class="table  table-bordered" id="listingTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Layout</th>
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
            <form method="post" action="{{route('admin.layout-create')}}" enctype="multipart/form-data">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Seat Layout</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <label class="form-label" for="">Seat Layout *</label>
                    <input type="text" name="layout" class="form-control  @error('layout') is-invalid @enderror" value="{{old('layout')}}">
                    @error('layout')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                    <input type="hidden" name="id" class="layout_id">
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="">Layout</label>
                        <input type="text" class="form-control layout" name="layout">

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
                "url": "{{route('admin.layout-list')}}",
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
                    "data": "layout"
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
        var name = $(this).data('title');
        $(".layout_id").val(id);
        $(".layout").val(name);

        $("#edit_layoutModal").modal('show');
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
                    "url": "{{route('admin.layout-delete')}}",
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