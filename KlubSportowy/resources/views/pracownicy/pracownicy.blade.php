@include('shared.html')

@include('shared.head', ['pageTitle' => 'Pracownicy'])
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

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Pracownicy</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Dane</th>
                            <th>Stanowisko</th>
                            <th>Drużyna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pracownicy as $pracownik)
                        <tr>
                            <td>{{ $pracownik['DANE'] }}</td>
                            <td>{{ $pracownik['STANOWISKO'] }}</td>
                            <td>{{ $pracownik['KATEGORIA'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>

