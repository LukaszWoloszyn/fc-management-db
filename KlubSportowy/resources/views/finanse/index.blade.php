@include('shared.html')

@include('shared.head', ['pageTitle' => 'Finanse'])
<body>
    @include('shared.navbar')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Finanse</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Kwota</th>
                            <th>Opis</th>
                            <th>Drużyna</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finanse as $f)
                            <tr>
                                <td>{{ $f['KWOTA'] }}</td>
                                <td>{{ $f['OPIS'] }}</td>
                                <td>{{ $f['NAZWA_DRUZYNY'] }}</td>
                                <td>
                                    <a href="{{ route('finanse.edit', $f['ID']) }} " class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('finanse.destroy', $f['ID']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('finanse.create') }}" class="btn btn-warning btn-sm">Dodaj finanse</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
