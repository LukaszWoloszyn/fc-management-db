@include('shared.head', ['pageTitle' => 'Edytuj rozgrywki'])
<body>
  @include('shared.navbar')
  <div class="container mt-5 mb-5">
    <div class="row mt-4 mb-4 text-center">
      <h1>Edytuj rozgrywki</h1>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ route('rozgrywki.update', $id) }}" class="needs-validation" novalidate onsubmit="return validateDates()">
            @csrf
            @method('PUT')
          <div class="form-group mb-2">
            <label for="nazwa" class="form-label">Nazwa</label>
            <input type="text" name="nazwa" id="nazwa" class="form-control" value="{{ $nazwa }}" required>
            <div class="invalid-feedback">Podaj tytuł!</div>
          </div>
          <div class="form-group mb-2">
            <label for="data_rozpoczecia" class="form-label">Data rozpoczecia</label>
            <input type="date" name="data_rozpoczecia" id="data_rozpoczecia" class="form-control" value="{{ $data_rozpoczecia }}" required>
            <div class="invalid-feedback">Niepoprawna data!</div>
          </div>
          <div class="form-group mb-2">
            <label for="data_zakonczenia" class="form-label">Data zakonczenia</label>
            <input type="date" name="data_zakonczenia" id="data_zakonczenia" class="form-control" value="{{ $data_zakonczenia }}" required>
            <div class="invalid-feedback">Niepoprawna data!</div>
          </div>
          <div class="text-center mt-4 mb-4">
            <input class="btn btn-primary" type="submit" value="Zaktualizuj">
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('shared.footer')

  <script>
    function validateDates() {
      const startDate = document.getElementById('data_rozpoczecia').value;
      const endDate = document.getElementById('data_zakonczenia').value;

      if (new Date(startDate) > new Date(endDate)) {
        alert('Data zakończenia musi być równa lub późniejsza niż data rozpoczęcia.');
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
