<div class="container-fluid header">
    <nav class="navbar navbar-expand-md navbar-light header-menu">
        <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i id="icon-navbar-toggler" class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#"><img src="{{ asset('/assets/images/hapo_learn.png') }}" alt="hapo learn"></a>
        <div class="collapse navbar-collapse justify-content-end menu" id="navbarSupportedContent">
            <ul class="navbar-nav text-center">
                <li class="nav-item text-center nav-home">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item text-center active">
                    <a class="nav-link" href="#">All Sources</a>
                </li>
                <li class="nav-item text-center nav-item-hidden">
                    <a class="nav-link" href="#">List lesson</a>
                </li>
                <li class="nav-item text-center nav-item-hidden">
                    <a class="nav-link" href="#">Lesson Details</a>
                </li>

                @auth
                    <li class="nav-item text-center dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-right" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item text-center profile">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                @else
                    <li class="nav-item text-center">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLoginRegister">Login/Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
</div>
