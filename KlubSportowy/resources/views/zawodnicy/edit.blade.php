@include('shared.head', ['pageTitle' => 'Edytuj zawodnika'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj zawodnika</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('zawodnicy.update', $zawodnik['id']) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="dane" class="form-label">Dane</label>
            <input type="text" name="dane" id="dane" class="form-control" value="{{ $zawodnik['dane'] }}" required>
            <div class="invalid-feedback">Podaj dane!</div>
          </div>
          <div class="form-group mb-2">
            <label for="wiek" class="form-label">Wiek</label>
            <input type="number" name="wiek" id="wiek" class="form-control" value="{{ $zawodnik['wiek'] }}" required>
            <div class="invalid-feedback">Podaj wiek!</div>
          </div>
          <div class="form-group mb-2">
            <label for="pozycja" class="form-label">Pozycja</label>
            <input type="text" name="pozycja" id="pozycja" class="form-control" value="{{ $zawodnik['pozycja'] }}" required>
            <div class="invalid-feedback">Podaj pozycję!</div>
          </div>
          <div class="form-group mb-2">
            <label for="druzyna_id" class="form-label">Drużyna</label>
            <select name="druzyna_id" id="druzyna_id" class="form-control" required>
              @foreach($druzyny as $druzyna)
                <option value="{{ $druzyna['ID'] }}" {{ $druzyna['ID'] == $zawodnik['druzyna_id'] ? 'selected' : '' }}>{{ $druzyna['KATEGORIA'] }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Wybierz drużynę!</div>
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
