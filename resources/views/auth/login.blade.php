@extends('layouts.guest')

{{-- @section('header-content')

    <ul id="container_buttons_log_reg" class="ml-auto">
        <!-- Authentication Links -->
        @guest
            <li class="button_log_reg">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="button_log_reg">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else --}}
            {{-- <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li> --}}
            {{-- <li>
              <a href="#">Prova</a>
            </li>
            <li>
              <a href="#">Prova</a>
            </li>
        @endguest
      </ul>

@endsection --}}


@section('guest-main')

    <div class="container_form_login">
        <form id="login_form" action="{{ route('login') }}" method="POST" class="container">
            @csrf
          <img src="{{asset("img/logo_login.png")}}" alt="Comodo">  
        <div class="wrapper_input">
            <div class="form-group">
            <label class="email_login" for="email">{{ __('E-Mail Address') }}</label>
              <div class="box_input_credential">
                <input id="email" type="email" class="input_credential form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail" autofocus>
              </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
           

            <div class="form-group">
                <label class="password_login" for="password">{{ __('Password') }}</label>
                <div class="box_input_credential">
                  <input id="password" type="password" class="input_credential form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input  class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button id="login_btn_form" class="btn-lg btn-block" type="submit" class="btn">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
          </div>  
        </form>
    </div>

@endsection
