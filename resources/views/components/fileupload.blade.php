@props(['path' => null, 'instance' => null])
<div class="mb-3 px-3 my-3">
    <label for="file_thumb">thumb</label>
    <input type="file" class="form-control" name="file_thumb" id="file_thumb">
</div>

@if(!empty($path))
    <div class="mb-3 px-3 my-3">
        <img width="300" src="{{asset($path)}}" alt="{{$instance->name}}" title="{{$instance->name}}">
    </div>
@endif
