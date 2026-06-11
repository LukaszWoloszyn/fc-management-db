@include('shared.html')

@include('shared.head', ['pageTitle' => 'Drużyny'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row mt-4 mb-4 text-center">
                    <h1>Drużyny</h1>
                  </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Nazwa drużyny</th>
                            <th>Kategoria</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($druzyny as $druzyna)
                        <tr>
                            <td>{{ $druzyna['NAZWA_DRUZYNY'] }}</td>
                            <td>{{ $druzyna['KATEGORIA'] }}</td>
                        <td>
                            {{-- <a href="{{ route('druzyny.show', $druzyna['ID']) }}" class="btn btn-primary">Pokaż</a> --}}
                                <a href="{{ route('druzyny.edit', $druzyna['ID']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                <form action="{{ route('druzyny.destroy', $druzyna['ID']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
                <a href="{{ route('druzyny.create') }}" class="btn btn-warning btn-sm">Dodaj Drużynę</a>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
