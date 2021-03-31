<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
  <head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-guest.css') }}" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="user-id" content="{{ Auth::user() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>

    <div id="guest_layout">

      @if(Route::currentRouteName() == 'home' || Route::currentRouteName() == 'menu-restaurant')
        <header id="header" :class="headerStatus ? 'active' : ''" :style="headerStatus ? 'background-color: #ba181b' : 'transparent'">
      @else
        <header id="header" style="background-color: #ba181b">
      @endif
        <div class="container">
          <div class="row">

            <div class="left col-lg-3 col-md-12" :style="displayNone ? 'display: none' : ''">
              <a href="{{ route('home') }}" id="home_link"><img class="logo" src="{{ asset("img/logo.png") }}" alt="logo"></a>
            </div>

            <div class="header_center col-lg-6 col-md-12 " :style="displayNone ? 'display: none' : ''">
            @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register' && Route::currentRouteName() != 'success')
              <input type="text" name="" value="" placeholder="Cerca ristorante per nome" v-model="searched" @keyup="getRestaurantByName">

              <transition name="slide">
                <div class="searched_box" v-if="searchedResults.length != 0">
                  <ul class="list-unstyled">
                    <li v-for="(restaurant, index) in searchedResults">
                      <a :href="'http://127.0.0.1:8000/restaurants/' + restaurant.slug">
                        <div class="container_image">
                          <img :src="restaurant.logo" alt="">
                        </div>
                        <span>@{{ restaurant.name }}</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </transition>
            @endif
            </div>

            <div class="right col-lg-3 col-md-12 text-right">
              {{-- header content login --}}
              <ul id="container_buttons_log_reg" class="list-unstyled">
                  <!-- Authentication Links -->
                @guest
                  <li class="btn_main login">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                    <li class="btn_main ml-3 register">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                  @endif

                  {{-- hamburger menu --}}
                  <button id="btn-hamburger" class="position-relative" @click="toggleActive('activeHamburger')">
                    <div class="line-1"></div>
                    <div class="line-2"></div>
                    <div class="line-3"></div>
                  </button>

                  {{-- drop down dell'hamburger menu --}}
                  <transition name="slide">
                    <ul id="hamburger_list" class="list-unstyled text-center" v-if="activeHamburger">
                      <li>
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      <li>
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                    </ul>
                  <transition/>
                @else
                  <li class="logo_section">
                    <a href="#" class="account" @click="toggleActive('activeLogOut')">
                      <img class="restaurant_logo" src="{{ Auth::user()->restaurant->logo }}" alt="restaurant_logo">
                      <i class="fas fa-angle-down" :class="activeLogOut ? 'active' : ''"></i>
                    </a>

                    <transition name="slide">
                      <ul class="drop_down_list list-unstyled" v-if="activeLogOut">
                        <li class="text-center">
                          <a href="{{ route('admin.restaurants.dashboard') }}"> Dashboard</a>
                        </li>

                        <li class="text-center">
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              Log Out
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                        </li>

                        <div class="exit_icon" v-if="activeLogOut">
                          <i class="far fa-times-circle" @click="toggleActive('activeLogOut')"></i>
                        </div>
                      </ul>
                    </transition>
                  </li>
                @endguest
              </ul>

            </div>
          </div>
        </div>

      </header>

      <main>
        {{-- MAIN, qui dentro ci andra a finire il segnaposto per le varie viste pubbliche --}}

        {{-- main login --}}
        @yield("guest-main")
        @yield('restaurant-main')
      </main>

      @include('/layouts/footer')

    </div>

    <script src="{{ asset("js/partials/layouts/frontend.js") }}" charset="utf-8"></script>
    @yield("page-guest-script")
  </body>
</html>
