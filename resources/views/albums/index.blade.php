<x-default>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}}) {{$album->album_name}}
                <div>
                    <a href="/albums/{{$album->id}}" class="btn btn-success">SHOW</a>
                    <a href="/albums/{{$album->id}}" class="btn btn-danger">DELETE</a>
                </div>
            </li>
        @endforeach
    </ul>
</x-default>
