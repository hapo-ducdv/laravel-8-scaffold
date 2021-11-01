<div class="modal fade login-register" id="modalLoginRegister" tabindex="-1" aria-labelledby="modalLoginRegisterLabel" aria-hidden="true">
    <div class="fix-width">
        <div class="modal-dialog">
            <div class="modal-content modal-content-cus">
                <div class="modal-title" id="modalLoginRegisterLabel">
                    <ul class="nav nav-tabs w-100">
                        <li class="nav-item w-50">
                            <a class="text-uppercase d-flex justify-content-center align-items-center nav-link active" id="loginTab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item w-50">
                            <a class="text-uppercase d-flex justify-content-center align-items-center nav-link" id="registerTab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <button type="button" class="tab-close rounded-circle" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <div class="container">
                            <form id="form-login" method="POST" action="{{ route('login') }}">
                                @csrf

                                @if(session('error') == config('app.login_error') || session('success') == config('app.register_success') || session('error') == config('app.login_incorrect'))
                                    <div hidden id="modalLogin" class="show-modal-login"></div>
                                @endif

                                <div class="form-group">
                                    <label class="form-label" for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="pwd">Password:</label>
                                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                                </div>
                                <div class="form-group w-100 form-check d-flex align-items-center">
                                    <div class="w-50">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="remember" value="1">
                                            <label class="custom-control-label form-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="w-50 text-right forgot-pwd"><u>Forgot password</u></a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn text-uppercase btn-cover btn-login">login</button>
                                </div>
                                <div class="d-flex align-items-center justify-content-center login-with">
                                    <div class="horizontal-line"><hr></div>
                                    <div class="text-center text">Login with</div>
                                    <div class="horizontal-line"><hr></div>
                                </div>
                                <div class="d-flex flex-column align-items-center login-account">
                                    <a href="{{ route('login.google') }}" class="btn d-flex justify-content-center align-items-center login-account-google">
                                        <i class="fab fa-google-plus-g"></i> Google
                                    </a>
                                    <a href="{{ route('login.facebook') }}" class="btn d-flex justify-content-center align-items-center login-account-facebook">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <div class="container">
                            <form id="form-register" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="rUsername">Username:</label>
                                    <input type="text" class="register-invalid form-control @error('username') is-invalid @enderror" id="rUsername" name="username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="rEmail">Email:</label>
                                    <input type="email" class="register-invalid form-control @error('email') is-invalid @enderror" id="rEmail" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="rPwd">Password:</label>
                                    <input type="password" class="register-invalid form-control @error('password') is-invalid @enderror" id="rPwd" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="rRepeatPwd">Repeat Password:</label>
                                    <input type="password" class="register-invalid form-control @error('password_confirmation') is-invalid @enderror" id="rRepeatPwd" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-center btn-register">
                                    <button type="submit" class="btn text-uppercase btn-cover btn-register">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
