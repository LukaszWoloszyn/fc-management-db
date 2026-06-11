@include('shared.head', ['pageTitle' => 'Dodaj nowe finanse'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe finanse</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('finanse.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="kwota" class="form-label">Kwota</label>
                        <input id="kwota" name="kwota" type="number" class="form-control @if ($errors->first('kwota')) is-invalid @endif" value="{{ old('kwota') }}">
                        <div class="invalid-feedback">Nieprawidłowa kwota!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="opis" class="form-label">Opis</label>
                        <input id="opis" name="opis" type="text" class="form-control @if ($errors->first('opis')) is-invalid @endif" value="{{ old('opis') }}">
                        <div class="invalid-feedback">Nieprawidłowy opis!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="druzyna_id" class="form-label">Drużyna</label>
                        <select id="druzyna_id" name="druzyna_id" class="form-control @if ($errors->first('druzyna_id')) is-invalid @endif">
                            <option value="">Wybierz drużynę</option>
                            @foreach($druzyny as $druzyna)
                                <option value="{{ $druzyna['ID'] }}">{{ $druzyna['KATEGORIA'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowa drużyna!</div>
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
