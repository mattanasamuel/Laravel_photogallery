<x-default>
    <x-slot:title>
        CREATE ALBUM
    </x-slot:title>
    <form method="post" action="{{ route('albums.store') }}">
        @csrf
        <div class="form-group px-3 my-3">
            <label for="album_name">Name</label>
            <input required class="form-control" type="text" name="album_name" id="album_name">
        </div>
        <div class="form-group px-3 my-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group px-3 my-3">
            <button class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</x-default>

