@include('shared.head', ['pageTitle' => 'Dodaj nowego sponsora'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowego sponsora</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('sponsorzy.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nazwa" class="form-label">Nazwa</label>
                        <input id="nazwa" name="nazwa" type="text" class="form-control @if ($errors->first('nazwa')) is-invalid @endif" value="{{ old('nazwa') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="kwota_sponsorowania" class="form-label">Kwota sponsorowania</label>
                        <input id="kwota_sponsorowania" name="kwota_sponsorowania" type="number" class="form-control @if ($errors->first('kwota_sponsorowania')) is-invalid @endif" value="{{ old('kwota_sponsorowania') }}">
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

