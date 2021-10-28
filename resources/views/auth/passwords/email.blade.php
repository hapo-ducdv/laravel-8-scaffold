@extends('layouts.app')

@section('content')
    <div class="container-fluid reset-password">
        <div class="content">
            @if (session('status'))
                <div class="alert alert-success message-sesson" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h5 class="text-center title">Reset Password</h5>
            <p class="text-center desc">Enter email to reset your password</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label class="email-label">Email:</label>
                    <input type="email" class="form-control email-input @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class=" btn btn-reset-password">Reset password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
