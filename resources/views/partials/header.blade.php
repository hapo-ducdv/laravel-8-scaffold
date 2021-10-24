<div class="container-fluid p-0 header">
    <nav class="navbar navbar-expand-md navbar-light p-0 header-menu">
        <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i id="icon-navbar-toggler" class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/assets/images/hapo_learn.png') }}" alt="hapo learn"></a>
        <div class="collapse navbar-collapse justify-content-end menu" id="navbarSupportedContent">
            <ul class="navbar-nav text-center">
                <li class="nav-item text-center nav-home {{ Route::is('home') ? 'nav-item-active' : ''}}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item text-center {{ Route::is(['course*', 'lesson*']) ? 'nav-item-active' : ''}}">
                    <a class="nav-link" href="{{ route('courses.index') }}">All Courses</a>
                </li>
                <li class="nav-item text-center nav-item-hidden">
                    <a class="nav-link" href="{{ route('courses.index') }}">List lesson</a>
                </li>
                <li class="nav-item text-center nav-item-hidden">
                    <a class="nav-link" href="{{ route('courses.index') }}">Lesson Details</a>
                </li>

                @auth
                    <li class="dropdown nav-item {{ Route::is(['user*']) ? 'nav-item-active' : ''}}">
                        <a class="btn dropdown-toggle nav-link btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->username ?? Auth::user()->fullname }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                                <i class="mr-3 fas fa-user"></i> Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                <i class="mr-3 fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item text-center">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLoginRegister">Login/Register</a>
                    </li>
                @endauth
            </ul>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center message-sesson">
                <i class="mr-2 fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center message-sesson">
                <i class="mr-2 fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @error('avatar')
        <div class="alert alert-danger text-center message-sesson">
            <i class="mr-2 fas fa-exclamation-circle"></i> {{ $message }}
        </div>
        @enderror

        @error('update_phone')
        <div class="alert alert-danger text-center message-sesson">
            <i class="mr-2 fas fa-exclamation-circle"></i> {{ $message }}
        </div>
        @enderror
    </nav>
</div>
