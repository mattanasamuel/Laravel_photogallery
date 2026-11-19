<x-default>
    <style>
        img {
            width: 15%;
            height: 15%;
        }
    </style>
    <table class="table w-auto">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">CREATED</th>
            <th scope="col">TITLE</th>
            <th scope="col">ALBUM</th>
            <th scope="col">THUMBNAIL</th>
            <th scope="col"></th>
        </tr>
        </thead>

        <tbody>
        @forelse ($images as $image)
            <tr>
                <td>{{$image->id}}</td>
                <td>{{$image->created_at}}</td>
                <td>{{$image->name}}</td>
                <td>{{$album->album_name}}</td>
                <td ><img src="{{asset($image->path)}}" alt="{{$image->name}}" ></td>
                <td>
                    <a href="{{route('photos.edit', $image)}}" class="btn btn-warning">EDIT</a>
                    <a href="{{route('photos.destroy', $image)}}" class="btn btn-danger">DELETE</a>
                </td>
            </tr>
            @empty
                <tr><td colspan="5">no images found</td></tr>
        @endforelse
        </tbody>
    </table>
    {{$images->links('vendor.pagination.bootstrap-5')}}
    <x-slot:script>
        $(document).ready(function(){
            $('div.alert').fadeOut(5000) //per far scomparire l'elemento banner dopo 5 secondi
            $('table').on('click', 'a.btn-danger', function(evt){
                evt.preventDefault()
                let url = $(this).attr('href')
                let element = url.split('/').pop() //restituisce l'ultimo elemento dell'array split
                let li = evt.target.closest('tr')
                //li = $(this).closest('li')


                $.ajax(url, {
                    method: 'DELETE',
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function(resp, status){
                        //alert('Record ' + resp.responseText + ' deleted')
                        $('div.alert')
                            .text('elemento ' + element + ' eliminato!')
                            .removeClass('alert-info alert-danger')
                            .addClass('alert-success')
                            .show().fadeOut(5000);
                        li.remove()

                        console.log(status)
                    },

                    error: function(resp){
                        $('div.alert')
                            .text('elemento ' + resp + ' NON eliminato!')
                            .removeClass('alert-info alert-success')
                            .addClass('alert-danger')
                            .show().fadeOut(5000);
                        console.error(resp);
                    }
                })


            })

        })
    </x-slot:script>
</x-default>

