@include('shared.head', ['pageTitle' => 'Edytuj statystyki'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj statystyki</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('statystyki.update', $id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="zawodnik_id" class="form-label">Zawodnik</label>
            <select name="zawodnik_id" id="zawodnik_id" class="form-control" required>
              @foreach($zawodnicy as $zawodnik)
                <option value="{{ $zawodnik['ID'] }}" {{ $zawodnik['ID'] == $zawodnik_id ? 'selected' : '' }}>{{ $zawodnik['DANE'] }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Wybierz zawodnika!</div>
          </div>
          <div class="form-group mb-2">
            <label for="mecz_id" class="form-label">Mecz</label>
            <select name="mecz_id" id="mecz_id" class="form-control" required>
              @foreach($harmonogramy as $mecz)
                <option value="{{ $mecz['ID'] }}" {{ $mecz['ID'] == $mecz_id ? 'selected' : '' }}>{{ $mecz['DATA_SPOTKANIA'] }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Wybierz mecz!</div>
          </div>
          <div class="form-group mb-2">
            <label for="bramki" class="form-label">Bramki</label>
            <input type="number" name="bramki" id="bramki" class="form-control" value="{{ $bramki }}" required>
            <div class="invalid-feedback">Podaj liczbę bramek!</div>
          </div>
          <div class="form-group mb-2">
            <label for="asysty" class="form-label">Asysty</label>
            <input type="number" name="asysty" id="asysty" class="form-control" value="{{ $asysty }}" required>
            <div class="invalid-feedback">Podaj liczbę asyst!</div>
          </div>
          <div class="form-group mb-2">
            <label for="zolte_kartki" class="form-label">Żółte kartki</label>
            <input type="number" name="zolte_kartki" id="zolte_kartki" class="form-control" value="{{ $zolte_kartki }}" required>
            <div class="invalid-feedback">Podaj liczbę żółtych kartek!</div>
          </div>
          <div class="form-group mb-2">
            <label for="czerwone_kartki" class="form-label">Czerwone kartki</label>
            <input type="number" name="czerwone_kartki" id="czerwone_kartki" class="form-control" value="{{ $czerwone_kartki }}" required>
            <div class="invalid-feedback">Podaj liczbę czerwonych kartek!</div>
          </div>
          <div class="text-center mt-4 mb-4">
            <input class="btn btn-primary" type="submit" value="Zaktualizuj">
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('shared.footer')
</body>
</html>
