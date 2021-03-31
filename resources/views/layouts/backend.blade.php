<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="user-id" content="{{ Auth::user() }}">
  {{-- bootstrap --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  {{-- my style --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>

  {{-- chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
  <div id="background">

    {{-- FORM PER LA MODIFICA DEL RISTORANTE --}}
    <div class="dashboard_edit_restaurant_form" :style="editForm ? 'display: block' : 'display: none'">
      <div class="form_box">

        <div class="product_create_img" v-if="url == null">
          @if(Auth::user()->restaurant)
            <img src="{{ $restaurant->logo }}" alt="product-image">
          @else
            <i class="fas fa-hotdog"></i>
          @endif
        </div>

        <div class="product_create_img" v-else>
            <img :src="url" alt="product-image">
        </div>

        {{-- rettangolo verde che contiene il nome della sezione --}}
        <div class="product_name_green_box text-center">
          <p>Modifica informazioni ristorante</p>
        </div>

      @if(Auth::user()->restaurant)
        <form class="px-3" action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method("PUT")

          <label for="logo" class="create_add_image" title="add photo">
            <input type="file" accept="image/*" name="logo" id="logo" @change="onFileChange">
            <i class="fas fa-camera-retro"></i>
          </label>

          <div class="create_product_input">
            {{-- box arancione contente l'icona --}}
            <div class="orange_icon_box">
              <i class="fas fa-store"></i>
            </div>

            {{-- retangolo piccolo verde con la label --}}
            <div class="small_green_box">
              <label for="address" class="mx-1 my-0">Indirizzo</label>
            </div>
            <input type="text" name="address" id="address" value="{{ $restaurant->address }}" placeholder="Inserisci l'indirizzo del tuo locale" min=4  title="deve contener almeno 4 caratteri e un numero"  required>
          </div>

          <div class="create_product_input">
            {{-- box arancione contente l'icona --}}
            <div class="orange_icon_box">
              <i class="fas fa-map-marker-alt"></i>
            </div>

            {{-- retangolo piccolo verde con la label --}}
            <div class="small_green_box">
              <label for="phone" class="mx-1 my-0">Telefono</label>
            </div>
            <input type="text" name="phone" id="phone" value="{{ $restaurant->phone }}" placeholder="Inserisci il numero del tuo locale"  min="6"  title="esempio +393205308707" required>
          </div>

          <div class="restaurant_image_hero_box">
            <label for="image_hero" title="aggiungi image_hero">
              <input type="file" accept="image/*" name="image_hero" id="image_hero" @change="onFileChangeSecond">
              <i class="fas fa-camera-retro"></i>
            </label>
            <img :src="url_one" v-if="url_one != null"/>
            <img src="{{ $restaurant->image_hero }}" alt="" v-else>
          </div>

          <div class="buttons_container">
            <input type="submit" id="submit" value="SALVA" class="btn-submit">
            <a href="#">
              <button type="button" class="btn_back" @click="activeEditForm">INDIETRO</button>
            </a>
          </div>
        </form>
      @endif
      </div>
    </div>

    <div id="container_dashboard" class="container-fluid p-0">

        {{-- parte sinistra del layout --}}
        <main id="dashboard_main" :class="mainClass">
          @yield('main')
        </main>

        {{-- parte destra del layout --}}

        <aside :class="asideClass">

          <div class="content" :class="contentAsideClass">

            <div id="aside_top">
              <i class="far fa-user-circle"></i>
              <span id="name_admin">{{ Auth::user()->name }}</span>
            </div>
            @if(Auth::user()->restaurant)
            <div id="aside_center">
              {{-- <h3>Pages</h3> --}}

              <ul id="route_list" class="list-unstyled">
                  <li class="my-5">
                    <a class="link-aside" href="{{ route('admin.restaurants.dashboard') }}">
                      <i class="fas fa-user-lock"></i>
                      <small>Dashboard</small>
                    </a>
                  </li>

                  <li class="my-5">
                    <a class="link-aside" href="{{ route('admin.restaurants.products.index') }}">
                      <i class="fas fa-pizza-slice dashboard-icon"></i>
                      <small>Prodotti</small>
                    </a>
                  </li>
                  <li class="my-5">
                    <a class="link-aside" href="{{ route('admin.restaurants.orders.index') }}">
                      <i class="far fa-chart-bar dashboard-icon"></i>
                      <small>Ordini</small>
                    </a>
                  </li>

                <li class="my-5">
                  <a class="link-aside" href="{{ route('home') }}">
                    <i class="fas fa-home"></i>
                    <small>Home</small>
                  </a>
                </li>
              </ul>

              <div id="settings_dashboard_container" class="text-center">
                <a href="#" @click="toggleSettings">
                  <span id="settings_dashboard">SETTINGS</span>
                  <i class="fas fa-cog settings-icon"></i>
                  <i class="fas fa-chevron-down" :class="activeSettings ? 'counterclockwise_180' : 'clockwise_180'"></i>
                </a>

                {{-- mostra/nascondi li dei settings --}}
                <transition name="slide">
                  <ul class="setting_list list-unstyled" v-if="activeSettings">
                    <li class="my-3">
                      <a href="#" @click="activeEditForm">
                        <span>Modifca profilo</span>
                        <i class="fas fa-edit settings-icon mb-3"></i>
                      </a>
                    </li>
                    <li class="my-3">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>Log Out</span>
                        <i class="fas fa-sign-out-alt settings-icon mb-3"></i>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                          @csrf
                      </form>
                    </li>
                  </ul>
                </transition>

              </div>

            </div>
            @endif
          </div>

          {{-- <div class="image_curve"></div> --}}
        </aside>


       {{-- burgericon --}}
      <a id="burgerIcon" @click="toggleShowAside" :class="activeAside ? 'active' : '' "><i></i></a>
      {{-- box con il form per editare le informazioni del ristorante --}}


    </div>
  </div>

  <script src="{{ asset("js/partials/layouts/backend.js") }}" charset="utf-8"></script>
  @yield('backend-script')
</body>
</html>
