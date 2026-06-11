@include('shared.head', ['pageTitle' => 'Dodaj nowe spotkanie'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe spotkanie</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('harmonogram.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="data_spotkania" class="form-label">Data spotkania</label>
                        <input id="data_spotkania" name="data_spotkania" type="date" class="form-control @if ($errors->first('data_spotkania')) is-invalid @endif" value="{{ old('data_spotkania') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="status_meczu" class="form-label">Status meczu</label>
                        <input id="status_meczu" name="status_meczu" type="text" class="form-control @if ($errors->first('status_meczu')) is-invalid @endif" value="{{ old('status_meczu') }}">
                        <div class="invalid-feedback">Nieprawidłowy nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="rozgrywki_id" class="form-label">Rozgrywki</label>
                        <select id="rozgrywki_id" name="rozgrywki_id" class="form-control @if ($errors->first('rozgrywki_id')) is-invalid @endif">
                            @foreach($rozgrywki as $rozgrywka)
                                <option value="{{ $rozgrywka['ID'] }}">{{ $rozgrywka['NAZWA'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowy wybór!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="druzyna_id" class="form-label">Drużyna</label>
                        <select id="druzyna_id" name="druzyna_id" class="form-control @if ($errors->first('druzyna_id')) is-invalid @endif">
                            @foreach($druzyny as $druzyna)
                                <option value="{{ $druzyna['ID'] }}">{{ $druzyna['KATEGORIA'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowy wybór!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="liczba_goli" class="form-label">Liczba zdobytych goli</label>
                        <input id="liczba_goli" name="liczba_goli" type="number" class="form-control @if ($errors->first('liczba_goli')) is-invalid @endif" value="{{ old('liczba_goli') }}">
                        <div class="invalid-feedback">Nieprawidłowa liczba!</div>
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
