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
                    <a href="{{route('photos.edit', $image)}}" class="btn btn-info my-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                    </a>
                    <a href="{{route('photos.destroy', $image)}}" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                    </a>
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

