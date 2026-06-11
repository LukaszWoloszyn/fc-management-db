@include('shared.html')

@include('shared.head', ['pageTitle' => 'Finanse'])
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
                    <h1>Finanse</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Kwota</th>
                            <th>Opis</th>
                            <th>Drużyna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finanse as $f)
                            <tr>
                                <td>{{ $f['KWOTA'] }}</td>
                                <td>{{ $f['OPIS'] }}</td>
                                <td>{{ $f['NAZWA_DRUZYNY'] }}</td>
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
