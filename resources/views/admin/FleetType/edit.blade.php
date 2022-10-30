<input type="hidden" name="id" class="layout_id" value="{{$data->id}}">
<div class=" mb-3">
    <label class="form-label" for="">Name *</label>
    <input type="text" name="name" class="form-control name " value="{{$data->name}}">
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
    <input type="number" name="no_of_desk" class="form-control " value="{{$data->no_of_desk}}">
</div>
<div class=" mb-3">
    <label class="form-label" for="">Facilities *</label>
    <select class="form-control edit_facility " name="facility[]" multiple="multiple">
        @foreach($facilities as $fac)
        <option value="{{$fac}}"  selected >{{$fac}}</option>
        @endforeach
    </select>
</div>
<div class=" mb-3">
    <label class="form-label" for="">Ac Status *</label>
    <select class="form-select" aria-label="Default select example" name="status">
        <option value="1" {{$data->status==1 ? "selected" :""}}>Yes </option>
        <option value="2" {{$data->status==2 ? "selected" :"">No </option>

    </select>
</div>