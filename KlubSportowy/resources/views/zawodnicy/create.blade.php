@include('shared.head', ['pageTitle' => 'Dodaj nowego zawodnika'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowego zawodnika</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('zawodnicy.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="dane" class="form-label">Imię i nazwisko</label>
                        <input id="dane" name="dane" type="text" class="form-control @if ($errors->first('dane')) is-invalid @endif" value="{{ old('dane') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="wiek" class="form-label">Wiek</label>
                        <input id="wiek" name="wiek" type="number" class="form-control @if ($errors->first('wiek')) is-invalid @endif" value="{{ old('wiek') }}">
                        <div class="invalid-feedback">Nieprawidłowy nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="pozycja" class="form-label">Pozycja</label>
                        <input id="pozycja" name="pozycja" type="text" class="form-control @if ($errors->first('pozycja')) is-invalid @endif" value="{{ old('pozycja') }}">
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
    </div>

    @include('shared.footer')
</body>

</html>

