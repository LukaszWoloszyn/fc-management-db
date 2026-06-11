@include('shared.html')

@include('shared.head', ['pageTitle' => 'Wycieczki górskie'])
<body>
    @include('shared.navbar')

    <div id="start">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="storage/img/z1.jpg" class="d-block mx-auto w-50"  alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="storage/img/z2.jpg" class="d-block mx-auto w-50"  alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="storage/img/z4.jpg" class="d-block mx-auto w-50"  alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="storage/img/z3.jpg" class="d-block mx-auto w-50"  alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div id="zawodnicy" class="container mt-5">
        <div class="row">
            <h1>Zawodnicy</h1>
        </div>
        <div class="row">
            @forelse ($zawodnicy as $z)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card1">
                        <img src="{{ asset('storage/img/logo.jpg') }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $z->dane }}</h5>
                            <p class="card-text"><b>Wiek: </b>{{ $z->wiek }}</p>
                            <p class="card-text"><b>Pozycja: </b>{{ $z->pozycja }}</p>
                            <p class="card-text"><b>Drużyna: </b>{{ $z->druzyna->kategoria }}</p>
                            {{-- <a href="{{ route('zawodnicy.show', $z->id) }}" class="btn btn-primary">Więcej szczegółów...</a> --}}
                        </div>
                    </div>
                </div>
            @empty
                <p>Brak zawodników.</p>
            @endforelse
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
