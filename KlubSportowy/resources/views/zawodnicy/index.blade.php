@include('shared.html')

@include('shared.head', ['pageTitle' => 'Zawodnicy'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Zawodnicy</h1>
                  </div>
                <form method="GET" action="{{ route('zawodnicy.index') }}" class="mb-4">
                    <div class="form-group">
                        <label for="druzyna_id">Filtruj według drużyny:</label>
                        <select id="druzyna_id" name="druzyna_id" class="form-control">
                            <option value="">Wszystkie drużyny</option>
                            @foreach($druzyny as $druzyna)
                                <option value="{{ $druzyna['ID'] }}" @if ($druzyna_id == $druzyna['ID']) selected @endif>{{ $druzyna['KATEGORIA'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </form>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Dane</th>
                            <th>Wiek</th>
                            <th>Pozycja</th>
                            <th>Drużyna</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($zawodnicy as $z)
                            <tr>
                                <td>{{ $z['DANE'] }}</td>
                                <td>{{ $z['WIEK'] }}</td>
                                <td>{{ $z['POZYCJA'] }}</td>
                                <td>{{ $z['NAZWA_DRUZYNY'] }}</td>
                                <td>
                                    <a href="{{ route('zawodnicy.edit', $z['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('zawodnicy.destroy', $z['ID']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('zawodnicy.create') }}" class="btn btn-warning btn-sm">Dodaj nowego zawodnika</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
