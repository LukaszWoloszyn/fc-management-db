@include('shared.html')

@include('shared.head', ['pageTitle' => 'Drużyny'])
<body>
    @include('shared.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Drużyny</h1>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa Drużyny</th>
                            <th>Kategoria</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($druzyny as $druzyna)
                    <tr>
                        <td>{{ $druzyna->id }}</td>
                        <td>{{ $druzyna->nazwa_druzyny }}</td>
                        <td>{{ $druzyna->kategoria }}</td>
                        <td>
                            <a href="{{ route('druzyny.show', $druzyna->id) }}" class="btn btn-primary">Pokaż</a>
                            <a href="{{ route('druzyny.edit', $druzyna->id ) }}"class="btn btn-warning btn-sm">Edytuj</a>
                            <form action="{{ route('druzyny.destroy', $druzyna->id) }}" method="POST" style="display:inline;">
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
