@extends('layouts.guest')

@section('header-content')
<div  class="container">
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
        @else
        @endguest
  @endsection
  @section('guest-main')      
    <div class="container_form_login">
                    
      <form method="POST" id="register_form"  class="container" action="{{ route('register') }}">
        @csrf
        <img src="{{asset("img/logo_login.png")}}" alt="Comodo">
        <div class="wrapper_input">
          <div class="form-group">
            <label class="label_none_md" for="name">{{ __('Name') }}</label>
            <div class="box_input_credential">  
              <input id="name" type="text" class="input_credential form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nome" pattern="[a-zA-Z ]{2,50}" title="inserisci nome e cognome questo campo può contentere da 2 a 50 caratteri, formato di sole lettere maiuscole e minuscole ed eventualmente da spazi" autofocus>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>     
          </div>
                      
          <div class="form-group">
            <label class="label_none_md"for="email">{{ __('E-Mail Address') }}</label>
              <div class="box_input_credential">
                <input id="email"  type="email" class="input_credential form-control @error('email') is-invalid @enderror"  placeholder="es. email@mail.me" name="email" value="{{ old('email') }}" required placeholder="E-mail"  autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div> 
          </div>

            <div class="form-group">
                <label class="label_none_md" for="password">{{ __('Password') }}</label>
                  <div class="box_input_credential">  
                    <input id="password" type="password" class="input_credential form-control @error('password') is-invalid @enderror" name="password" title="La password deve avere almeno 8 caratteri" required placeholder="Password" autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>  
            </div>

            <div class="form-group">
                <label class="label_none_md" for="password-confirm">{{ __('Confirm Password') }}</label>
                <div class="box_input_credential">
                  <input id="password-confirm" type="password" class="form-control input_credential" name="password_confirmation"  placeholder="le password non corrispondono" placeholder="Conferma Passswords" required autocomplete="new-password">
                </div>  
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" id="register_btn_form" class="btn-lg btn-block">
                        {{ __('Register') }}
                    </button>
                </div>
              </div>
        
            </div>
          </div>  
        </div> 
          </form>
               
            
        
    </div>
</div>
@endsection
