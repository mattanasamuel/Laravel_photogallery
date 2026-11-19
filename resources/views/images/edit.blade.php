<x-default>
    <form method="post" action="{{ route('photos.update', ['photo' => $photo->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group px-3 my-3">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{$photo->name}}">
        </div>

        <x-fileupload :instance="$photo" :path="$photo->path"/> <!-- componente che centralizza l'upload dei file -->

        <div class="form-group px-3 my-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$photo->description}}</textarea>
        </div>
        <div class="form-group px-3 my-3">
            <button class="btn btn-primary">UPDATE</button>
        </div>
    </form>
</x-default>

