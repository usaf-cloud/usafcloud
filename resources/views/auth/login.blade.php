@extends('auth.layouts.app')

@section('content')

<div class="w-3/4 sm:w-3/5 md:w-1/3 lg:w-2/5 xl:w-1/5">
    <div class="card card-body p-5">

        <h2 class="text-center mb-4 text-2xl text-blue">Sign in</h2>

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="">Email Address</label>
                <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="flex align-items-center justify-content-between mt-4">

                <a href="{{ route('register') }}">Create Account</a>

                <button type="submit" class="btn btn-outline-primary">Sign In</button>

            </div>

        </form>
    </div>

    {{-- @if (Route::has('password.request'))
        <div class="text-center mt-2">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
    @endif --}}

</div>

@endsection
