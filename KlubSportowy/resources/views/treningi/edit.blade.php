@include('shared.head', ['pageTitle' => 'Edytuj trening'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj trening</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('treningi.update', $id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" value="{{ $data }}" required>
            <div class="invalid-feedback">Podaj datę!</div>
          </div>
          <div class="form-group mb-2">
            <label for="lokalizacja" class="form-label">Lokalizacja</label>
            <input type="text" name="lokalizacja" id="lokalizacja" class="form-control" value="{{ $lokalizacja }}" required>
            <div class="invalid-feedback">Podaj lokalizację!</div>
          </div>
          <div class="form-group mb-2">
            <label for="druzyna_id" class="form-label">Drużyna</label>
            <select name="druzyna_id" id="druzyna_id" class="form-control" required>
              @foreach($druzyny as $druzyna)
                <option value="{{ $druzyna['ID'] }}" {{ $druzyna['ID'] == $druzyna_id ? 'selected' : '' }}>{{ $druzyna['KATEGORIA'] }}</option>
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
