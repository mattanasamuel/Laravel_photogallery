<x-default>
    <div class="row">
        @foreach($images as $image)
            <div class="col-sm-4 col-md-3 col-lg-2 my-2">

                <div class="card">
                    <a href="{{asset($image->path)}}" data-lightbox="{{$album->album_name}}" data-title="{{$image->name}}">
                        <img src="{{asset($image->path)}}" class="card-img-top img-fluid rounded" alt="{{$image->name}}">
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$image->name}}</h5>
                </div>
            </div>
        @endforeach
    </div>
</x-default>
