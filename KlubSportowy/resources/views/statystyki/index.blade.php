@include('shared.html')

@include('shared.head', ['pageTitle' => 'Statystyki'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Statystyki</h1>
                </div>
                <form method="GET" action="{{ route('statystyki.index') }}" class="mb-4">
                    <div class="form-group">
                        <label for="data_meczu">Filtruj według daty meczu:</label>
                        <select id="data_meczu" name="data_meczu" class="form-control">
                            <option value="">Wszystkie mecze</option>
                            @foreach($harmonogramyDaty as $data)
                                <option value="{{ $data }}" {{ $data_meczu == $data ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </form>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Zawodnik</th>
                            <th>Mecz</th>
                            <th>Bramki</th>
                            <th>Asysty</th>
                            <th>Żółte Kartki</th>
                            <th>Czerwone Kartki</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statystyki as $s)
                            <tr>
                                <td>{{ $s['DANE'] }}</td>
                                <td>{{ $s['DATA_SPOTKANIA'] }}</td>
                                <td>{{ $s['BRAMKI'] }}</td>
                                <td>{{ $s['ASYSTY'] }}</td>
                                <td>{{ $s['ZOLTE_KARTKI'] }}</td>
                                <td>{{ $s['CZERWONE_KARTKI'] }}</td>
                                <td>
                                    <a href="{{ route('statystyki.edit', $s['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('statystyki.destroy', $s['ID']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('statystyki.create') }}" class="btn btn-warning btn-sm">Dodaj statystyki</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
