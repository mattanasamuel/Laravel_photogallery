@props(['path' => null, 'instance' => null])
<div class="mb-3 px-3 my-3">
    <label for="file_path">thumb</label>
    <input type="file" class="form-control" name="file_path" id="file_path">
</div>

@if($path)
    <p>image path: {{$path}}</p>
    <div class="mb-3 px-3 my-3">
        <img width="300" src="{{asset($path)}}" alt="{{$instance->name}}" title="{{$instance->name}}">
    </div>
@endif
