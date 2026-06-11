@include('shared.head', ['pageTitle' => 'Zawodnicy z drużyny'])
<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Zawodnicy z drużyny</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dane</th>
                            <th>Wiek</th>
                            <th>Pozycja</th>
                            <th>Drużyna ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($zawodnicy as $z)
                            <tr>
                                <td>{{ $z['ID'] }}</td>
                                <td>{{ $z['DANE'] }}</td>
                                <td>{{ $z['WIEK'] }}</td>
                                <td>{{ $z['POZYCJA'] }}</td>
                                <td>{{ $z['DRUZYNA_ID'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
