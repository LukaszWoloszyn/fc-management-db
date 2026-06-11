@include('shared.head', ['pageTitle' => 'Najlepsi strzelcy'])
<body>
    @include('shared.navbar')

    <div id="start">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="storage/img/z5.jpg" class="d-block mx-auto"  alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Najlepsi strzelcy</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                @if($zawodnicy)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dane</th>
                                <th>Kategoria</th>
                                <th>Suma Goli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($zawodnicy as $z)
                                <tr>
                                    <td>{{ $z['DANE'] }}</td>
                                    <td>{{ $z['DRUZYNA'] }}</td>
                                    <td>{{ $z['SUMA_GOLI'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Brak danych.</p>
                @endif
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
