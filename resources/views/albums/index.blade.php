<x-default>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <ul class="list-group">

        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between container">
                ({{$album->id}}) {{$album->album_name}}
                <div class="container">
                    <a href="/albums/{{$album->id}}" class="btn btn-success">SHOW</a>
                    <a href="{{route('albums.edit', $album)}}" class="btn btn-warning">EDIT</a>
                    @if($album->photos_count > 0)
                        <a href="{{route('albums.images', $album)}}" class="btn btn-warning">VIEW IMAGES ({{$album->photos_count}})</a>
                    @endif
                    <a href="/albums/{{$album->id}}" class="btn btn-danger">DELETE</a>
                </div>
                @if($album->album_thumb)
                    <div class="mb-3 px-3 my-3">
                        <img width="300" src="{{asset($album->path)}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
    <x-slot:script>

        /*
        $(document).ready(function(){
        $('ul').on('click', 'a.btn-danger', function(evt){ //intercetto il clic su un elemento ul
        evt.preventDefault(); //prevengo il browser da seguire l'href nel tag a
        // const urlAlbum = evt.target.getAttribute('href');
        let btn = $(this) //salvo il riferimento al bottone, avvolgo dentro le parentesi per renderlo elemento jquery
        const urlAlbum = btn.attr('href') //leggo l'elemento href nel bottone, this è sempre l'elemento che invoca la funzione
        console.log(urlAlbum)
        $.ajax(urlAlbum, {
        method:'DELETE',
        complete:function(resp){

        window.location.reload();
        },
        success:function(resp){
        console.log(resp.rows) //file json stringizzato della risposta pervenuta dal metodo destroy del controller
        alert('eliminazione riuscita')
        },
        error:function(resp){
        alert('errore eliminazione: ' . resp.rows)
        }
        })
        })
        }) */

        $(document).ready(function(){
        $('div.alert').fadeOut(5000) //per far scomparire l'elemento banner dopo 5 secondi
        $('ul').on('click', 'a.btn-danger', function(evt){
        evt.preventDefault()
        let url = $(this).attr('href')
        let element = url.split('/').pop() //restituisce l'ultimo elemento dell'array split
        let li = evt.target.closest('li')
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


        /*
        document.addEventListener('DOMContentLoaded', function(){
        alert('dom')
        document.querySelectorAll('li a.btn-danger').forEach(ele => {
        ele.addEventListener('click', (evt)=>{
        evt.preventDefault(); //impedisce di ricaricare auto
        alert(evt.target.getAttribute('href'))
        })
        })
        }) */
    </x-slot:script>


</x-default>
