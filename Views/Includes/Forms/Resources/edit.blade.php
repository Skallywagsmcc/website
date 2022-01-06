{{--Add form action and method and csrf within your page and wrap this file within an include --}}


<div class="row box">
    <div class="col-sm-12 py-2">
    <select name="type" id="" class="form-control bg-dark text-white">
        <option value="{{$request->resources->type}}">Current selection : {{$request->resources->type}}</option></option>
        @foreach($request->type as $type)
            <option class="bg-dark form-control text-white" value="{{$type}}">{{$type}}</option>
        @endforeach
    </select>
</div>
</div>
<div class="row box my-2">
    <div class="col-sm-12 pt-1"><label for="type">Resource Name</label></div>
    <div class="col-sm-12 pb-1">
        <input type="text" class="form-control" name="name" value="{{$request->resources->name}}">
    </div></div>
<div class="row box my-2">
    <div class="col-sm-12 pt-1"><label for="value">Resource value</label></div>
    <div class="col-sm-12 pb-1">
        <input type="text" class="form-control" name="value" value="{{$request->resources->value}}">
    </div>
</div>





