@include('shared.head', ['pageTitle' => 'Dodaj nową rozgrywkę'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nową rozgrywkę</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('rozgrywki.store') }}" class="needs-validation" novalidate onsubmit="return validateDates()">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nazwa" class="form-label">Nazwa</label>
                        <input id="nazwa" name="nazwa" type="text" class="form-control @if ($errors->first('nazwa')) is-invalid @endif" value="{{ old('nazwa') }}" required>
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="data_rozpoczecia" class="form-label">Data rozpoczecia</label>
                        <input id="data_rozpoczecia" name="data_rozpoczecia" type="date" class="form-control @if ($errors->first('data_rozpoczecia')) is-invalid @endif" value="{{ old('data_rozpoczecia') }}" required>
                        <div class="invalid-feedback">Nieprawidłowa data!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="data_zakonczenia" class="form-label">Data zakonczenia</label>
                        <input id="data_zakonczenia" name="data_zakonczenia" type="date" class="form-control @if ($errors->first('data_zakonczenia')) is-invalid @endif" value="{{ old('data_zakonczenia') }}" required>
                        <div class="invalid-feedback">Nieprawidłowa data!</div>
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Dodaj">
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
