@include('shared.head', ['pageTitle' => 'Edytuj pracownika'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj pracownika</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('pracownicy.update', $id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="dane" class="form-label">Dane</label>
            <input type="text" name="dane" id="dane" class="form-control" value="{{ $dane  }}" required>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="stanowisko" class="form-label">Stanowisko</label>
            <input type="text" name="stanowisko" id="stanowisko" class="form-control" value="{{ $stanowisko }}" required>
            <div class="invalid-feedback">Podaj nazwę pliku obrazu!</div>
          </div>
          <div class="form-group mb-2">
            <label for="druzyna_id" class="form-label">Drużyna</label>
            <select id="druzyna_id" name="druzyna_id" class="form-control @if ($errors->first('druzyna_id')) is-invalid @endif">
                <option value="" selected disabled>Wybierz drużynę</option>
                @foreach($druzyny as $druzyna)
                    <option value="{{ $druzyna['ID'] }}">{{ $druzyna['KATEGORIA'] }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Nieprawidłowa drużyna!</div>
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

