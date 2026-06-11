@include('shared.html')

@include('shared.head', ['pageTitle' => 'Budżety drużyn'])
<body>
    @include('shared.navbar')

    <div id="start">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="storage/img/z5.jpg" class="d-block mx-auto"  alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Budżety drużyn</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Drużyna</th>
                            <th>Budżet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budzety as $b)
                            <tr>
                                <td>{{ $b['KATEGORIA'] }}</td>
                                <td>{{ $b['BUDZET'] }}</td>
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
