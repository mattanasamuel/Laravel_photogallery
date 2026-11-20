<x-default>

@if($photo->id)
    <h3>edit image "{{$photo->name}}"</h3>
    <form method="post" action="{{ route('photos.update', ['photo' => $photo->id]) }}" enctype="multipart/form-data">
        @method('PATCH')
@else
            <h3>create image for album "{{$album->album_name}}"</h3>
    <form method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data">
@endif
        @include('components.counterrors')
        @csrf
        <div class="mb-3 px-3 my-3">
            <label for="album_id">Album</label>
            <select class="form-select" name="album_id" id="album_id">
                <option value="" disabled></option>
                @foreach($albums as $item)
                    <option value="{{$item->id }}" {{$item->id == $album->id ? 'selected' : ''}}>{{$item->album_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 px-3 my-3">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{$photo->name}}">
        </div>

        <x-fileupload :instance="$photo" :path="$photo->path"/> <!-- componente che centralizza l'upload dei file -->

        <div class="mb-3 px-3 my-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$photo->description}}</textarea>
        </div>
        <div class="mb-3 px-3 my-3">
            <button class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</x-default>

