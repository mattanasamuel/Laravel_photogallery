<x-default>
    <div class="row">
        @foreach($albums as $album)
            <div class="col-sm-4 col-md-3 col-lg-2 my-2">
                <div class="card">
                    <a href="{{route('gallery.album.images', $album->id)}}">
                        <img src="{{asset($album->path)}}" class="card-img-top img-fluid rounded" alt="{{$album->album_name}}" title="{{$album->album_name}}">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{$album->album_name}}</h4>
                        <p class="card-text">created {{$album->created_at->diffForHumans()}} by {{$album->user->name}}</p>
                        <div class="card">
                            <ul>
                                @foreach($album->categories as $category)
                                    <li>{{$category->category_name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-default>
