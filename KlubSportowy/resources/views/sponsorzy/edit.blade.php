@include('shared.head', ['pageTitle' => 'Edytuj sponsora'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj sponsora</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('sponsorzy.update', $id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="nazwa" class="form-label">Nazwa</label>
            <input type="text" name="nazwa" id="nazwa" class="form-control" value="{{ $nazwa  }}" required>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="kwota_sponsorowania" class="form-label">Kwota sponsorowania</label>
            <input type="number" name="kwota_sponsorowania" id="kwota_sponsorowania" class="form-control" value="{{ $kwota_sponsorowania }}" required>
            <div class="invalid-feedback">Podaj nazwę pliku obrazu!</div>
          </div>
          <div class="form-group mb-2">
            <label for="druzyna_id" class="form-label">Drużyna</label>
            <select name="druzyna_id" id="druzyna_id" class="form-control" required>
              @foreach ($druzyny as $druzyna)
                <option value="{{ $druzyna['ID'] }}" {{ $druzyna['ID'] == $druzyna_id ? 'selected' : '' }}>{{ $druzyna['KATEGORIA'] }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Podaj nazwę pliku obrazu!</div>
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
