@include('shared.html')

@include('shared.head', ['pageTitle' => 'Dodaj nową drużynę'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nową drużynę</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('druzyny.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nazwa_druzyny" class="form-label">Nazwa drużyny</label>
                        <input id="nazwa_druzyny" name="nazwa_druzyny" type="text" class="form-control @if ($errors->first('nazwa_druzyny')) is-invalid @endif" value="{{ old('nazwa_druzyny') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="kategoria" class="form-label">Kategoria</label>
                        <input id="kategoria" name="kategoria" type="text" class="form-control @if ($errors->first('kategoria')) is-invalid @endif" value="{{ old('kategoria') }}">
                        <div class="invalid-feedback">Nieprawidłowy nazwa!</div>
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Dodaj">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>

</html>

