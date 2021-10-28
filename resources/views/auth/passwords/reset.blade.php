@extends('layouts.app')

@section('content')
    <div class="container-fluid reset-password">
        <div class="content">
            <h5 class="text-center title">ResetPasswords</h5>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                <div class="form-group">
                    <label class="new-password-label">Password:</label>
                    <input type="password" class="form-control new-password-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="repeat-new-password-label">Password confirmation:</label>
                    <input type="password" class="form-control new-password-input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class=" btn btn-reset-new-password">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
