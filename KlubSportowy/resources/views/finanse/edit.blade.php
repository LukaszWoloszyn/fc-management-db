@include('shared.head', ['pageTitle' => 'Edytuj finanse'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Edytuj finanse</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('finanse.update', $id) }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="kwota" class="form-label">Kwota</label>
                        <input type="number" name="kwota" id="kwota" class="form-control" value="{{ $kwota }}" required>
                        <div class="invalid-feedback">Podaj kwotę!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="opis" class="form-label">Opis</label>
                        <input type="text" name="opis" id="opis" class="form-control" value="{{ $opis }}" required>
                        <div class="invalid-feedback">Podaj opis!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="druzyna_id" class="form-label">Drużyna</label>
                        <select name="druzyna_id" id="druzyna_id" class="form-control" required>
                            <option value="">Wybierz drużynę</option>
                            @foreach($druzyny as $druzyna)
                                <option value="{{ $druzyna['ID'] }}" @if($druzyna['ID'] == $druzyna_id) selected @endif>{{ $druzyna['KATEGORIA'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Wybierz drużynę!</div>
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-primary" type="submit" value="Zaktualizuj">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
