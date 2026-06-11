@include('shared.html')

@include('shared.head', ['pageTitle' => 'Zawodnicy'])
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
      <h1>Zawodnicy</h1>
    </div>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <form method="GET" action="{{ route('zawodnicy.filter') }}" class="mb-4">
          <div class="form-group">
            <label for="druzyna_id">Filtruj według drużyny:</label>
            <select id="druzyna_id" name="druzyna_id" class="form-control">
              <option value="">Wszystkie drużyny</option>
              @foreach($druzyny as $druzyna)
                <option value="{{ $druzyna['ID'] }}" @if ($druzyna_id == $druzyna['ID']) selected @endif>{{ $druzyna['KATEGORIA'] }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Filtruj</button>
        </form>
      </div>
    </div>
    <div class="row">
        @forelse ($zawodnicy as $zawodnik)
            <div class="col-12 col-sm-6 col-lg-4  mb-4">
                <div class="card">
                    <div class="card-body">
                            <img src="{{ asset('storage/img/logo.jpg') }}" class="card-img-top">
                            <div class="card-body">
                              <p class="card-text"><b>Dane: </b> {{ $zawodnik['DANE'] }}</p>
                              <p class="card-text"><b>Wiek: </b> {{ $zawodnik['WIEK'] }}</p>
                              <p class="card-text"><b>Pozycja: </b> {{ $zawodnik['POZYCJA'] }}</p>
                              <p class="card-text"><b>Drużyna: </b> {{ $zawodnik['NAZWA_DRUZYNY'] }}</p>
                              <a href="{{ route('zawodnicy.index') }}" class="btn btn-primary">Wróć do listy</a>
                            </div>
                    </div>
                </div>
            </div>
            @empty
                <p>Brak oferty.</p>
            @endforelse
        </div>
  </div>
  @include('shared.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pk1E90Hszlw5EECMfTb/NwRQwFnCSdBsgBtXoZh0+ajMQ5eMf0D0xH9pZdz+7j2" crossorigin="anonymous"></script>
</body>
</html>
