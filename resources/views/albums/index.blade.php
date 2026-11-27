<x-default>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <ul class="list-group">

        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between container">
                ({{$album->id}}) {{$album->album_name}}
                {{$album->created_at->format('d/m/Y')}}
                <div class="container">
                    <a href="{{route('albums.show', ['album' => $album->id])}}" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-json" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM4.151 15.29a1.2 1.2 0 0 1-.111-.449h.764a.58.58 0 0 0 .255.384q.105.073.25.114.142.041.319.041.245 0 .413-.07a.56.56 0 0 0 .255-.193.5.5 0 0 0 .084-.29.39.39 0 0 0-.152-.326q-.152-.12-.463-.193l-.618-.143a1.7 1.7 0 0 1-.539-.214 1 1 0 0 1-.352-.367 1.1 1.1 0 0 1-.123-.524q0-.366.19-.639.192-.272.528-.422.337-.15.777-.149.456 0 .779.152.326.153.5.41.18.255.2.566h-.75a.56.56 0 0 0-.12-.258.6.6 0 0 0-.246-.181.9.9 0 0 0-.37-.068q-.324 0-.512.152a.47.47 0 0 0-.185.384q0 .18.144.3a1 1 0 0 0 .404.175l.621.143q.326.075.566.211a1 1 0 0 1 .375.358q.135.222.135.56 0 .37-.188.656a1.2 1.2 0 0 1-.539.439q-.351.158-.858.158-.381 0-.665-.09a1.4 1.4 0 0 1-.478-.252 1.1 1.1 0 0 1-.29-.375m-3.104-.033a1.3 1.3 0 0 1-.082-.466h.764a.6.6 0 0 0 .074.27.5.5 0 0 0 .454.246q.285 0 .422-.164.137-.165.137-.466v-2.745h.791v2.725q0 .66-.357 1.005-.355.345-.985.345a1.6 1.6 0 0 1-.568-.094 1.15 1.15 0 0 1-.407-.266 1.1 1.1 0 0 1-.243-.39m9.091-1.585v.522q0 .384-.117.641a.86.86 0 0 1-.322.387.9.9 0 0 1-.47.126.9.9 0 0 1-.47-.126.87.87 0 0 1-.32-.387 1.55 1.55 0 0 1-.117-.641v-.522q0-.386.117-.641a.87.87 0 0 1 .32-.387.87.87 0 0 1 .47-.129q.265 0 .47.129a.86.86 0 0 1 .322.387q.117.255.117.641m.803.519v-.513q0-.565-.205-.973a1.46 1.46 0 0 0-.59-.63q-.38-.22-.916-.22-.534 0-.92.22a1.44 1.44 0 0 0-.589.628q-.205.407-.205.975v.513q0 .562.205.973.205.407.589.626.386.217.92.217.536 0 .917-.217.384-.22.589-.626.204-.41.205-.973m1.29-.935v2.675h-.746v-3.999h.662l1.752 2.66h.032v-2.66h.75v4h-.656l-1.761-2.676z"/>
                        </svg>
                    </a>
                    <a href="{{route('albums.edit', $album)}}" class="btn btn-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                    </a>
                    <a href="{{route('photos.create', ['album_id' => $album->id])}}" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
                        </svg>
                    </a>
                    @if($album->photos_count > 0)
                        <a href="{{route('albums.images', $album)}}" class="btn btn-success">
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"></path>
                                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"></path>
                            </svg>
                            view {{$album->photos_count}} image{{$album->photos_count > 1 ? 's' : ''}}
                        </a>

                    @endif
                    <a href="{{route('albums.index', ['album' => $album->id])}}" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                    </a>
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
        })
        vecchio metodo con javascript
        */

        $(document).ready(function(){
        $('div.alert').fadeOut(5000) //per far scomparire l'elemento banner dopo 5 secondi
        $('ul').on('click', 'a.btn-danger', function(evt){
        evt.preventDefault()
        let url = $(this).attr('href')
        let element = url.split('/').pop() //restituisce l'ultimo elemento dell'array split
        let li = evt.target.closest('li')
        //li = $(this).closest('li')



        //nuovo con ajax

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
