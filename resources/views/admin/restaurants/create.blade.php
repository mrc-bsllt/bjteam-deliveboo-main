@extends('layouts.backend')

@section('main')
  <section id="restaurant_create" class="container my-3">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

     <div class="form_box">
      <div class="product_name_green_box">
        <p>Crea Ristorante</p>
      </div>
      <div class="product_create_img">
        <img :src="url" v-if="url != null"/>
        <i class="fas fa-store" v-else></i>
      </div>

      <form class="" action="{{ route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("POST")

        <label for="logo" class="create_add_image" title="aggiungi logo">
          <input type="file" accept="image/*" name="logo" id="logo" @change="onFileChange">
          <i class="fas fa-camera-retro"></i>
        </label>

        <div class="restaurant_image_hero_box">
          <label for="image_hero" title="aggiungi image_hero">
            <input type="file" accept="image/*" name="image_hero" id="image_hero" @change="onFileChangeSecond">
            <i class="fas fa-camera-retro"></i>
          </label>
          <img :src="url_one" v-if="url_one != null"/>
        </div>

        <div class="create_product_input">
          <div class="orange_icon_box">
            <i class="fas fa-store"></i>
          </div>
          <div class="small_green_box">
            <label for="name" class="mx-1 my-0">Nome</label>
          </div>
          <input type="text" name="name" id="name" value="{{ old('name')}}" placeholder="Inserisci il nome del tuo esercizio commerciale" required>
        </div>

        <div class="create_product_input">
          <div class="orange_icon_box">
            <i class="fas fa-id-card"></i>
          </div>
          <div class="small_green_box">
            <label for="p_iva" class="mx-1 my-0">partia iva</label>
          </div>
          <input type="text" name="p_iva" id="p_iva" placeholder="partita iva" value="{{ old('p_iva')}}" title="deve essere composto da 11 cifre" title="es: 12345678912" required maxlength="11" minlength="11">
        </div>

        <div class="create_product_input">
           <div class="orange_icon_box">
              <i class="fas fa-map-marker-alt"></i>
           </div>
          <div class="small_green_box">
            <label for="address" class="mx-1 my-0">Indirizzo</label>
          </div>
          <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Inserisci l'indirizzo del tuo locale" min=4  title="deve contener almeno 4 caratteri e un numero"  required>
        </div>
        <div class="create_product_input">
          <div class="orange_icon_box">
            <i class="fas fa-phone"></i>
          </div>
          <div class="small_green_box">
            <label for="phone" class="mx-1 my-0">Telefono</label>
          </div>
          <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Inserisci il numero del tuo locale"  min="6"  title="esempio +393205308707" required>
        </div>
        <div class="create_product_input">
          <select style=" width:100%; height:25px" class="select_form_category" id="categories" name="categories[]" required title="aggiungi una o più categorie es: Pizzeria Pub" multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

          {{-- </select>
        </div> --}}

        <input type="submit" id="submit" value="AGGIUNGI" class="btn-submit">
      </form>


    </div>
  </section>
@endsection

{{-- @section("backend-create")
@endsection --}}
