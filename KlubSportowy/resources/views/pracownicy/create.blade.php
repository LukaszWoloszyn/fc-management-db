@include('shared.head', ['pageTitle' => 'Dodaj nowego pracownika'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowego pracownika</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('pracownicy.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="dane" class="form-label">Dane</label>
                        <input id="dane" name="dane" type="text" class="form-control @if ($errors->first('dane')) is-invalid @endif" value="{{ old('dane') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="stanowisko" class="form-label">Stanowisko</label>
                        <input id="stanowisko" name="stanowisko" type="text" class="form-control @if ($errors->first('stanowisko')) is-invalid @endif" value="{{ old('stanowisko') }}">
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

