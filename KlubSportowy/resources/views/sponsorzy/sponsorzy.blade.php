@include('shared.html')

@include('shared.head', ['pageTitle' => 'Sponsorzy'])
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
                    <h1>Sponsorzy</h1>
                </div>
                <form method="GET" action="{{ route('sponsorzy.filter') }}" class="mb-4">
                    <div class="form-group">
                        <label for="druzyna_id">Filtruj według drużyny:</label>
                        <select id="druzyna_id" name="druzyna_id" class="form-control">
                            <option value="">Wszystkie drużyny</option>
                            @foreach($druzyny as $druzyna)
                                <option value="{{ $druzyna['ID'] }}" {{ request()->get('druzyna_id') == $druzyna['ID'] ? 'selected' : '' }}>{{ $druzyna['KATEGORIA'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </form>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Kwota sponsorowania</th>
                            <th>Drużyna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sponsorzy as $sponsor)
                            <tr>
                                <td>{{ $sponsor['NAZWA'] }}</td>
                                <td>{{ $sponsor['KWOTA_SPONSOROWANIA'] }}</td>
                                <td>{{ $sponsor['NAZWA_DRUZYNY'] }}</td>
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
