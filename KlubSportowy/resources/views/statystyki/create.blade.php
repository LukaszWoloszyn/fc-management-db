@include('shared.head', ['pageTitle' => 'Dodaj nowe statystyki'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe statystyki</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('statystyki.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="zawodnik_id" class="form-label">Zawodnik</label>
                        <select name="zawodnik_id" id="zawodnik_id" class="form-control" required>
                            @foreach($zawodnicy as $zawodnik)
                                <option value="{{ $zawodnik['ID'] }}">{{ $zawodnik['DANE'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Wybierz zawodnika!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="mecz_id" class="form-label">Mecz</label>
                        <select name="mecz_id" id="mecz_id" class="form-control" required>
                            @foreach($harmonogramy as $mecz)
                                <option value="{{ $mecz['ID'] }}">{{ $mecz['DATA_SPOTKANIA'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Wybierz mecz!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="bramki" class="form-label">Bramki</label>
                        <input id="bramki" name="bramki" type="number" class="form-control @if ($errors->first('bramki')) is-invalid @endif" value="{{ old('bramki') }}" required>
                        <div class="invalid-feedback">Podaj liczbę bramek!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="asysty" class="form-label">Asysty</label>
                        <input id="asysty" name="asysty" type="number" class="form-control @if ($errors->first('asysty')) is-invalid @endif" value="{{ old('asysty') }}" required>
                        <div class="invalid-feedback">Podaj liczbę asyst!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="zolte_kartki" class="form-label">Żółte kartki</label>
                        <input id="zolte_kartki" name="zolte_kartki" type="number" class="form-control @if ($errors->first('zolte_kartki')) is-invalid @endif" value="{{ old('zolte_kartki') }}" required>
                        <div class="invalid-feedback">Podaj liczbę żółtych kartek!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="czerwone_kartki" class="form-label">Czerwone kartki</label>
                        <input id="czerwone_kartki" name="czerwone_kartki" type="number" class="form-control @if ($errors->first('czerwone_kartki')) is-invalid @endif" value="{{ old('czerwone_kartki') }}" required>
                        <div class="invalid-feedback">Podaj liczbę czerwonych kartek!</div>
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
