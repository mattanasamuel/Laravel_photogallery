<!doctype html>
<html lang="it" class="h-100" data-bs-theme="auto">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'PhotoGallery' }}</title>

    <!-- Bootstrap 5.3 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Regola estratta da sticky-footer-navbar.css per non far coprire il contenuto dalla navbar */
        main > .container {
            padding: 70px 15px 0;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md fixed-top bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PhotoGallery</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('albums.index') }}">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nuovo Album</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET" action="{{ route('albums.index') }}">
                    <input class="form-control me-2" type="search" name="album_name" placeholder="Cerca album..." aria-label="Search" value="{{ request('album_name') }}" />
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<!-- Contenuto principale della pagina -->
<main class="flex-shrink-0">
    <div class="container">
        {{ $slot }}
    </div>
</main>

<footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
        <span class="text-body-secondary">PhotoGallery Laravel</span>
    </div>
</footer>

<!-- Bootstrap 5.3 JS Bundle via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> <!-- aggiungo jquery da CDN -->
<script>

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
</script>
</body>
</html>
