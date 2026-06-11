@include('shared.html')

@include('shared.head', ['pageTitle' => 'Harmonogram'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Harmonogram</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Data Spotkania</th>
                            <th>Status Meczu</th>
                            <th>Rozgrywki</th>
                            <th>Drużyna</th>
                            <th>LICZBA ZDOBYTYCH GOLI</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($harmonogramy as $h)
                        <tr>
                            <td>{{ $h['DATA_SPOTKANIA'] }}</td>
                            <td>{{ $h['STATUS_MECZU'] }}</td>
                            <td>{{ $h['ROZGRYWKI_NAZWA'] }}</td>
                            <td>{{ $h['DRUZYNA_NAZWA'] }}</td>
                            <td>{{ $h['LICZBA_GOLI'] }}</td>
                            <td>
                                <a href="{{ route('harmonogram.edit', $h['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                <form action="{{ route('harmonogram.destroy', $h['ID']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('harmonogram.create') }}" class="btn btn-warning btn-sm">Dodaj spotkanie</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
