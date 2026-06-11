<nav class="navbar navbar-expand-lg nav-bg">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">Real Madryt</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('teams')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Drużyny
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('teams')}}">Zobacz drużyny</a></li>
            <li><a class="dropdown-item" href="{{route('druzyny.index')}}">Edytuj drużyny</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('teams')}}">Drużyny</a>
            </li>
        @endif


          @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('finances')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Finanse
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('finances')}}">Zobacz finanse</a></li>
            <li><a class="dropdown-item" href="{{route('finanse.budzety')}}">Zobacz budżet</a></li>
            <li><a class="dropdown-item" href="{{route('finanse.index')}}">Edytuj finanse</a></li>
          </ul>
        </li>
        @else
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('finances')}}">Zobacz finanse</a></li>
            <li><a class="dropdown-item" href="{{route('finanse.budzety')}}">Zobacz budżet</a></li>
          </ul>
        @endif

          @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('schedule')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Harmonogram
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('schedule')}}">Zobacz harmonogram</a></li>
            <li><a class="dropdown-item" href="{{route('harmonogram.index')}}">Edytuj harmonogram</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('schedule')}}">Harmonogram</a>
            </li>
        @endif

        @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('employees')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pracownicy
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('employees')}}">Zobacz pracowników</a></li>
            <li><a class="dropdown-item" href="{{route('pracownicy.index')}}">Edytuj pracowników</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('employees')}}">Pracownicy</a>
            </li>
        @endif

        @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('gameplay')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Rozgrywki
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('gameplay')}}">Zobacz Rozgrywki</a></li>
            <li><a class="dropdown-item" href="{{route('rozgrywki.index')}}">Edytuj Rozgrywki</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('gameplay')}}">Rozgrywki</a>
            </li>
        @endif

        @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('sponsors')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sponsorzy
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('sponsors')}}">Zobacz Sponsorzy</a></li>
            <li><a class="dropdown-item" href="{{route('sponsorzy.index')}}">Edytuj Sponsorzy</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('sponsors')}}">Sponsorzy</a>
            </li>
        @endif

        @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('stats')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Statystyki
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('stats')}}">Zobacz statystyki</a></li>
            <li><a class="dropdown-item" href="{{route('statystyki.index')}}">Edytuj statystyki</a></li>
            <li><a class="dropdown-item" href="{{route('statystyki.najwiecej_goli')}}">Najwięcej goli</a></li>
            <li><a class="dropdown-item" href="{{route('statystyki.najwiecej_asyst')}}">Najwięcej asyst</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{route('players')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Statystyki
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('stats')}}">Zobacz statystyki</a></li>
              <li><a class="dropdown-item" href="{{route('statystyki.najwiecej_goli')}}">Najwięcej goli</a></li>
              <li><a class="dropdown-item" href="{{route('statystyki.najwiecej_asyst')}}">Najwięcej asyst</a></li>
            </ul>
          </li>
        @endif

        @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('trainers')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Treningi
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('trainers')}}">Zobacz Treningi</a></li>
            <li><a class="dropdown-item" href="{{route('treningi.index')}}">Edytuj Treningi</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('trainers')}}">Treningi</a>
            </li>
        @endif

        @if (session('user') && session('is_admin'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('players')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Zawodnicy
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('players')}}">Zobacz Zawodnicy</a></li>
            <li><a class="dropdown-item" href="{{route('zawodnicy.index')}}">Edytuj Zawodnicy</a></li>
          </ul>
        </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('players')}}">Zawodnicy</a>
            </li>
        @endif




        </ul>
        <ul class="navbar-nav">
            @if (session('user'))
                <li class="nav-item me-2">
                    <a class="nav-link" href="{{ route('logout') }}">{{ session('user')->imie }}, wyloguj się</a>
                </li>
            @else
                <li class="nav-item me-4">
                    <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Zaloguj się</a>
                </li>
                {{-- <li class="nav-item me-2">
                    <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Zarejestruj się</a>
                </li> --}}
            @endif
        </ul>
      </div>
    </div>
  </nav>
