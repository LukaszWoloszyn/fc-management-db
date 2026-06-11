@include('shared.head', ['pageTitle' => 'Edytuj drużynę'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj drużynę</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('druzyny.update', $id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="nazwa_druzyny" class="form-label">Nazwa drużyny</label>
            <input type="text" name="nazwa_druzyny" id="nazwa_druzyny" class="form-control" value="{{ $nazwa }}" required>
            <div class="invalid-feedback">Podaj nazwę drużyny!</div>
          </div>
          <div class="form-group mb-2">
            <label for="kategoria" class="form-label">Kategoria</label>
            <input type="text" name="kategoria" id="kategoria" class="form-control" value="{{ $kat }}" required>
            <div class="invalid-feedback">Podaj kategorię!</div>
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
