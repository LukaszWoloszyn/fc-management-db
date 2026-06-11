@include('shared.html')

@include('shared.head', ['pageTitle' => 'Statystyki'])
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
                    <h1>Statystyki</h1>
                </div>
                <form method="GET" action="{{ route('statystyki.filter') }}" class="mb-4">
                    <div class="form-group">
                        <label for="data_meczu">Filtruj według daty meczu:</label>
                        <select id="data_meczu" name="data_meczu" class="form-control">
                            <option value="">Wszystkie mecze</option>
                            @foreach($harmonogramyDaty as $data)
                                <option value="{{ $data }}" {{ $data_meczu == $data ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </form>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Zawodnik</th>
                            <th>Mecz</th>
                            <th>Bramki</th>
                            <th>Asysty</th>
                            <th>Żółte kartki</th>
                            <th>Czerwone kartki</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statystyki as $statystyka)
                            <tr>
                                <td>{{ $statystyka['DANE'] }}</td>
                                <td>{{ $statystyka['DATA_SPOTKANIA'] }}</td>
                                <td>{{ $statystyka['BRAMKI'] }}</td>
                                <td>{{ $statystyka['ASYSTY'] }}</td>
                                <td>{{ $statystyka['ZOLTE_KARTKI'] }}</td>
                                <td>{{ $statystyka['CZERWONE_KARTKI'] }}</td>
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
