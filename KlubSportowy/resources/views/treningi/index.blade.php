@include('shared.html')

@include('shared.head', ['pageTitle' => 'Treningi'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Treningi</h1>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Lokalizacja</th>
                            <th>Drużyna</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($treningi as $t)
                            <tr>
                                <td>{{ $t['DATA'] }}</td>
                                <td>{{ $t['LOKALIZACJA'] }}</td>
                                <td>{{ $t['KATEGORIA'] }}</td>
                                <td>
                                    {{-- <a href="{{ route('treningi.show', $t['ID']) }}" class="btn btn-primary">Pokaż</a> --}}
                                    <a href="{{ route('treningi.edit', $t['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('treningi.destroy', $t['ID']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('treningi.create') }}" class="btn btn-warning btn-sm">Dodaj trening</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
