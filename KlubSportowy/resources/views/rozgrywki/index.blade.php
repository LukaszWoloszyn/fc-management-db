@include('shared.html')

@include('shared.head', ['pageTitle' => 'Rozgrywki'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Rozgrywki</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Data rozpoczęcia</th>
                            <th>Data zakończenia</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rozgrywki as $r)
                            <tr>
                                <td>{{ $r['NAZWA'] }}</td>
                                <td>{{ $r['DATA_ROZPOCZECIA'] }}</td>
                                <td>{{ $r['DATA_ZAKONCZENIA'] }}</td>
                                <td>
                                    {{-- <a href="{{ route('rozgrywki.show', $r['ID']) }}" class="btn btn-primary">Pokaż</a> --}}
                                    <a href="{{ route('rozgrywki.edit', $r['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('rozgrywki.destroy', $r['ID']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('rozgrywki.create') }}" class="btn btn-warning btn-sm">Dodaj rozgrywkę</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
