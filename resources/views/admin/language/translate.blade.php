@extends('layouts.master')
@section('page_title','BusBooking')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<h4 class="fw-bold py-3 mb-4">Seat Layout <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary float-end">Add New</a></h4>
<div class="card mt-5">
    <div class="table-responsive text-nowrap">
        <form action="{{route('admin.translate_update')}}" method="post">
            @csrf
            <table class="table table-hover table-bordered" id="listingTable">
                <thead>
                    <tr>
                        <th>key</th>
                        <th>value</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach($data as $key => $keys)
                    <tr>
                        <td>
                            {{$key}} <a href="javascript:void(0)" class="btn btn-default btn-sm ml-5 removeTextField"><i class="fa fa-trash-alt"></i></a>
                        </td>
                        <td>
                            @if (isset($data) && array_key_exists($key, $data))
                            <input type="text" class="form-control" name="translations[{{$key}}]" value="{{$data[$key]}}">
                            @else
                            <input type="text" class="form-control" name="translations[{{$key}}]">
                            @endif
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="col-md-3 mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control newTranslationText" name="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary createText">{{__('Create')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    
    $("body").on("click", ".createText", function () {
        var text = $(".newTranslationText").val();
        var name = 'translations[' + htmlspecialchars(text) + ']';
        var textbox = $("<input type='textbox' class='form-control'>");
        textbox.attr('name', name);
    //    $("table").find("tbody").append('<tr><td>' + text + '</td><td><input type="text" class="form-control" name='+name+'></td></tr>');
        var tr = $("<tr>");
        tr.html($("<td>").html(text));
        tr.append($("<td>").html(textbox))
        $("table").append(tr);
        $("#myModal").modal('hide');
    });
</script>
<script>
           

           function htmlspecialchars(str) {
               if (str == null)
                   return '';

               return String(str).
                       replace(/&/g, '&amp;').
                       replace(/</g, '&lt;').
                       replace(/>/g, '&gt;').
                       replace(/"/g, '&quot;').
                       replace(/'/g, '&#039;');
           };
           $(window).on('load', function () {
               $('#loadingDiv').fadeOut();
           });
           $("select").select2();
           $("body").on("change", ".switchLanguage", function () {
               var lang = $(this).val();

               if (lang) {
                   location.href = "/language/switch/" + lang;
               }
           });
       </script>
@stop