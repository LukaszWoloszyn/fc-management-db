@include('shared.html')

@include('shared.head', ['pageTitle' => 'Pracownicy'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Pracownicy</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Dane</th>
                            <th>Stanowisko</th>
                            <th>Drużyna</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pracownicy as $p)
                        <tr>
                            <td>{{ $p['DANE'] }}</td>
                            <td>{{ $p['STANOWISKO'] }}</td>
                            <td>{{ $p['KATEGORIA'] }}</td>
                            <td>
                                <a href="{{ route('pracownicy.edit', $p['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                <form action="{{ route('pracownicy.destroy', $p['ID']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('pracownicy.create') }}" class="btn btn-warning btn-sm">Dodaj pracownika</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
