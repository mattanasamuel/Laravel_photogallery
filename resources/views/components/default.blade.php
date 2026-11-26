<!doctype html>
<html lang="it" class="h-100" data-bs-theme="auto">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'PhotoGallery' }}</title>

    <!-- Bootstrap 5.3 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> <!-- aggiungo jquery da CDN -->

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
                    @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('albums.index') }}">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('albums.create')}}">Nuovo Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('photos.create')}}">Nuova Immagine</a>
                    </li>
                    @endauth
                </ul>
                <form class="d-flex" role="search" method="GET" action="{{ route('albums.index') }}">
                    <input class="form-control me-2" type="search" name="album_name" placeholder="Cerca album..." aria-label="Search" value="{{ request('album_name') }}" />
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @guest

                            <li>
                                <a href="{{route('login')}}" class="nav-link">Login</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}" class="nav-link">Register</a>
                            </li>
                        </ul>
                    @endguest
                    @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                    {{Auth::user()->name}} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li class="">
                                        <a href="#" class="nav-link"
                                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                        >Logout</a>


                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                            {{csrf_field()}}
                                        </form>
                                    </li>
                                    <li class="">
                                        <a href="{{route('dashboard')}}" class="nav-link">dashboard</a>
                                    </li>
                                </ul>
                            </li>
                    @endauth
            </div>
        </div>
    </nav>
</header>

<!-- Contenuto principale della pagina -->
<main class="flex-shrink-0">

    <div class="container">
        <p class="text-center fs-1">{{$title ?? ''}}</p>
        <x-alert-info/> <!-- per poterlo reperire con jquery -->
        {{ $slot }}
    </div>


</main>

<footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
        <span class="text-body-secondary">PhotoGallery Laravel</span>
    </div>
</footer>

<!-- Bootstrap 5.3 JS Bundle via CDN -->
<script>
    {{$script ?? ''}}
</script>
</body>
</html>
