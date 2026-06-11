<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
    @include('shared.head', ['pageTitle' => 'Register'])
    <body class="d-flex flex-column min-vh-100">
        @include('shared.navbar')
        <div class="row d-flex justify-content-center w-100">
            <div class="col-12 d-flex justify-content-center mt-4 mb-auto ">
                <h2 class="mb-0">Don't you have an account?</h2>
            </div>
            <div class="col-12 d-flex justify-content-center mt-2 mb-auto ">
                <h2 class="mb-auto">Register here!</h2>
            </div>

            <div class="col-10 col-sm-10 col-md-6 col-lg-4 mt-4">
                <form method="POST" action="{{route('register.perform')}}" class="needs-validation" novalidate >
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Imię</label>
                        <input id="name" name="name" type="text" class="form-control  @if ($errors->first('name')) is-invalid @endif" value="{{ old('name') }}">
                        <div class="invalid-feedback">Wprowadź imie!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="surname" class="form-label">Nazwisko</label>
                        <input id="surname" name="surname" type="text" class="form-control @if ($errors->first('surname')) is-invalid @endif" value="{{ old('surname') }}">
                        <div class="invalid-feedback">Wprowadź nazwisko!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="login" class="form-label">Login</label>
                        <input id="login" name="login" type="text" class="form-control @if ($errors->first('login')) is-invalid @endif" value="{{ old('login') }}">
                        <div class="invalid-feedback">Wprowadź login!</div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="form-label">Hasło</label>
                        <input id="password" name="password" type="password" class="form-control @if ($errors->first('password')) is-invalid @endif">
                        <div class="invalid-feedback">Hasło musi mieć co najmniej 8 znaków!</div>
                    </div>
                    <div class="text-center mt-5 mb-4">
                        <input class="btn btn-primary btn-lg" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        @include('shared.footer')
    </body>

</html>
