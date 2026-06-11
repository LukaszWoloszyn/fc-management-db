@include('shared.head', ['pageTitle' => 'Edytuj spotkanie'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj spotkanie</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('harmonogram.update', $id) }}" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="data_spotkania" class="form-label">Data spotkania</label>
            <input type="date" name="data_spotkania" id="data_spotkania" class="form-control" value="{{ $data_spotkania }}" required>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="status_meczu" class="form-label">Status meczu</label>
            <input type="text" name="status_meczu" id="status_meczu" class="form-control" value="{{ $status_meczu }}" required>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="rozgrywki_id" class="form-label">Rozgrywka</label>
            <select name="rozgrywki_id" id="rozgrywki_id" class="form-control" required>
              @foreach ($rozgrywki as $rozgrywka)
                <option value="{{ $rozgrywka['ID'] }}" {{ $rozgrywka['ID'] == $rozgrywki_id ? 'selected' : '' }}>{{ $rozgrywka['NAZWA'] }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="druzyna_id" class="form-label">Drużyna</label>
            <select name="druzyna_id" id="druzyna_id" class="form-control" required>
              @foreach ($druzyny as $druzyna)
                <option value="{{ $druzyna['ID'] }}" {{ $druzyna['ID'] == $druzyna_id ? 'selected' : '' }}>{{ $druzyna['KATEGORIA'] }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="liczba_goli" class="form-label">Liczba zdobytych goli</label>
            <input type="text" name="liczba_goli" id="liczba_goli" class="form-control" value="{{ $liczba_goli }}" required>
            <div class="invalid-feedback">Podaj tytuł!</div>
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
