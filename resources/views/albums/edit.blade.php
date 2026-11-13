<x-default>
    <x-slot:title>
        EDIT ALBUM "{{$album->album_name}}"
    </x-slot:title>
    <form method="post" action="{{ route('albums.update', ['album' => $album->id]) }}">
        @csrf
        @method('PATCH')
        <div class="form-group px-3 my-3">
            <label for="album_name">Name</label>
            <input class="form-control" type="text" name="album_name" id="album_name" value="{{$album->album_name}}">
        </div>
        <div class="form-group px-3 my-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$album->description}}</textarea>
        </div>
        <div class="form-group px-3 my-3">
            <button class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</x-default>

