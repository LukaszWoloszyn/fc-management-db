@include('shared.head', ['pageTitle' => 'Dodaj nowy trening'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowy trening</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('treningi.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="data" class="form-label">Data</label>
                        <input id="data" name="data" type="date" class="form-control @if ($errors->first('data')) is-invalid @endif" value="{{ old('data') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="lokalizacja" class="form-label">Lokalizacja</label>
                        <input id="lokalizacja" name="lokalizacja" type="text" class="form-control @if ($errors->first('lokalizacja')) is-invalid @endif" value="{{ old('lokalizacja') }}">
                        <div class="invalid-feedback">Nieprawidłowy nazwa!</div>
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
                        <input class="btn btn-success" type="submit" value="Dodaj">
                    </div>
                </form>
            </div>
        </div>
        {{-- <a href="{{ route('druzyny.index') }}">Wróć do listy drużyn</a> --}}
    </div>

    @include('shared.footer')
</body>

</html>

