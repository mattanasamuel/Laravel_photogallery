<x-default>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <ul class="list-group">

        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between container">
                ({{$album->id}}) {{$album->album_name}}
                <div class="container">
                    <a href="/albums/{{$album->id}}" class="btn btn-success">SHOW</a>
                    <a href="/albums/{{$album->id}}/edit" class="btn btn-warning">EDIT</a>
                    <a href="/albums/{{$album->id}}" class="btn btn-danger">DELETE</a>
                </div>
                @if($album->album_thumb)
                    <div class="mb-3 px-3 my-3">
                        <img width="300" src="{{$album->album_thumb}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</x-default>
