@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">Language <a href="" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary float-end add_counry">Add New</a> </h4>
<div class="card mt-5">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover table-bordered" id="listingTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>{{trns('language')}}</th>
                    <th>Code</th>
                    <th>created at</th>
                    <th>action</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

            </tbody>
        </table>

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
            <form action="{{route('admin.language-create')}}" post="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label class="input-control">Language</label>
                        <input type="text" class="form-control" name="language">
                    </div>
                    <div class="form-group mt-3">
                        <label class="input-control">Code</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="form-group mt-3">
                        <label class="input-control">direction</label>
                        <input type="text" class="form-control" name="direction">
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
</div>
<div id="edit_language" class="modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Language</h4>
            </div>
            <form action="{{route('admin.language-update')}}" post="post">
                <input type="hidden" name="id" id="language_id">
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label class="input-control">Language</label>
                        <input type="text" class="form-control" id="language_name" name="language_name">
                    </div>
                    <div class="form-group mt-3">
                        <label class="input-control">Code</label>
                        <input type="text" class="form-control" id="code" name="code" >
                    </div>
                    <div class="form-group mt-3">
                        <label class="input-control">direction</label>
                        <input type="text" class="form-control" id="direction" name="direction">
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
                [3, "desc"]
            ],
            "ajax": {
                "url": "{{route('admin.language_list')}}",
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
                    "data": "code"
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
                "targets": [0, 4] /* column index */
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
                    "url": "{{route('admin.language-delete')}}",
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
    $("body").on("click", ".edit_language", function() {

        var id = $(this).data('id');
        $.ajax({
            "type": "get",
            "url": "{{route('admin.language-edit')}}",
            data: {
                id: id
            },
            success: function(data) {
                if (data.status == 1) {
                      $("#language_id").val(data.data.id);
                    $("#language_name").val(data.data.name);
                    $("#code").val(data.data.code);
                    $("#direction").val(data.data.direction);
                   $("#edit_language").modal('show');
                   
                } else {
                    errorMsg(data.msg);
                }
            }
        });

    });
</script>
@stop