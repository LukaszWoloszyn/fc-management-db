<!DOCTYPE html>

  <html lang="en" data-bs-theme="light">
    @include('shared.head', ['pageTitle' => 'Log in'])

    <body class="d-flex flex-column min-vh-100">
        @include('shared.navbar')
        @include('shared.session-succes')

        <div class="row d-flex justify-content-center w-100">
            <div class="col-12 d-flex justify-content-center mt-3 mb-auto ">
              <h2 class="mb-auto">Zaloguj się</h2>
            </div>

            <div class="col-10 col-sm-10 col-md-6 col-lg-4 mt-5">
                <form method="POST" action="{{ route('login.authenticate') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group mb-2">
                        <label for="login" class="form-label">Login</label>
                        <input id="login" name="login" type="text" class="form-control @if ($errors->first('login')) is-invalid @endif" value="{{ old('login') }}">
                        <div class="invalid-feedback">Błędny login!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="form-label">Hasło</label>
                        <input id="password" name="password" type="password" class="form-control @if ($errors->first('password')) is-invalid @endif">
                        <div class="invalid-feedback">Błędne hasło!</div>
                    </div>
                    <div class="text-center mt-5 mb-4">
                        <input class="btn btn-primary" type="submit" value="Zaloguj">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('shared.footer')
    </body>
</html>
