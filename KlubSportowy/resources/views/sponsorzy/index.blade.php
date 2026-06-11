@include('shared.html')

@include('shared.head', ['pageTitle' => 'Sponsorzy'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Sponsorzy</h1>
                </div>
                <form method="GET" action="{{ route('sponsorzy.index') }}" class="mb-4">
                    <div class="form-group">
                        <label for="druzyna_id">Filtruj według drużyny:</label>
                        <select id="druzyna_id" name="druzyna_id" class="form-control">
                            <option value="">Wszystkie drużyny</option>
                            @foreach($druzyny as $druzyna)
                                <option value="{{ $druzyna['ID'] }}" {{ $druzyna_id == $druzyna['ID'] ? 'selected' : '' }}>{{ $druzyna['KATEGORIA'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </form>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Kwota sponsorowania</th>
                            <th>Drużyna</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sponsorzy as $s)
                            <tr>
                                <td>{{ $s['NAZWA'] }}</td>
                                <td>{{ $s['KWOTA_SPONSOROWANIA'] }}</td>
                                <td>{{ $s['NAZWA_DRUZYNY'] }}</td>
                                <td>
                                    <a href="{{ route('sponsorzy.edit', $s['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('sponsorzy.destroy', $s['ID']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('sponsorzy.create') }}" class="btn btn-warning btn-sm">Dodaj sponsora</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
