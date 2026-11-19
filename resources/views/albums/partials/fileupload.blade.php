<div class="mb-3 px-3 my-3">
    <label for="album_thumb"></label>
    <input type="file" class="form-control" name="album_thumb" id="album_thumb">
</div>
@if($album->album_thumb)
    <div class="mb-3 px-3 my-3">
        <img width="300" src="{{asset($album->path)}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
    </div>
@endif
