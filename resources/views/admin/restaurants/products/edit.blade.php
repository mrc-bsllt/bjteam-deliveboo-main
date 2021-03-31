@extends('layouts.backend')

@section('main')
  <section id="product_edit" class="container my-3">

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

      {{-- cerchio grande che contiene l'icona principale della sezione --}}
      <div class="product_create_img" v-if="url == null">
        @if($product->image)
          <img src="{{ $product->image }}" alt="product-image">
        @else
          <i class="fas fa-hotdog"></i>
        @endif
      </div>
      <div class="product_create_img" v-else>
          <img :src="url" alt="product-image">
      </div>


      {{-- rettangolo verde che contiene il nome della sezione --}}
      <div class="product_name_green_box">
        <p>Modifica prodotto</p>
      </div>
      <form class="" action="{{ route('admin.restaurants.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <label for="image" class="create_add_image" title="add photo">
          <input type="file" accept="image/*" name="image" id="image" @change="onFileChange">
          <i class="fas fa-camera-retro"></i>
        </label>

        <div class="create_product_input">
          {{-- box arancione contente l'icona --}}
          <div class="orange_icon_box">
            <i class="fas fa-hamburger"></i>
          </div>

          {{-- retangolo piccolo verde con la label --}}
          <div class="small_green_box">
            <label for="name" class="mx-1 my-0">Nome</label>
          </div>
          <input type="text" name="name" id="name" value="{{ $product->name }}"placeholder="Inserisci il nome del prodotto" title="inserisci il nome del prodotto con almento 2 caratteri" min="2" max=60 required>
        </div>

        <div class="create_product_input">
          {{-- box arancione contente l'icona --}}
          <div class="orange_icon_box">
            <i class="fas fa-align-left"></i>
          </div>

          {{-- retangolo piccolo verde con la label --}}
          <div class="small_green_box">
            <label for="description" class="mx-1 my-0">Descrizione</label>
          </div>
           <textarea max="6000" name="description" id="description" placeholder="ingredienti" title="inserisci ingredienti" required>{{  $product->description }}</textarea>
        </div>

        <div class="create_product_input">
          {{-- box arancione contente l'icona --}}
          <div class="orange_icon_box">
            <i class="fas fa-dollar-sign"></i>
          </div>

          {{-- retangolo piccolo verde con la label --}}
          <div class="small_green_box">
            <label for="price" class="mx-1 my-0">Prezzo</label>
          </div>
          <input type="number" name="price" id="price" value="{{ $product->price }}" placeholder="Prezzo (€)" min="0.01" max="999" step="0.01" required>
        </div>

        <div class="create_product_check_box">
          {{-- qudrato arancione in position absolute --}}
          <div class="orange_icon_box">
            <i class="fas fa-carrot"></i>
          </div>

          {{-- box con l'input e la label --}}
          <div class="input_control">
            <input {{ $product->is_vegetarian === 1 ? 'checked' : '' }} type="checkbox" name="is_vegetarian" id="is_vegetarian" value="1">
            <label for="is_vegetarian" class="mx-1 my-0">Vegetariano</label>
          </div>

        </div>

        <div class="create_product_check_box">
          {{-- qudrato arancione in position absolute --}}
          <div class="orange_icon_box">
            <i class="fas fa-bread-slice"></i>
          </div>

          {{-- box con l'input e la label --}}
          <div class="input_control">
            <input {{ $product->is_glutenfree === 1 ? 'checked' : '' }} type="checkbox" name="is_glutenfree" id="is_glutenfree" value="1">
            <label for="is_glutenfree" class="mx-1 my-0">Glutine Free</label>
          </div>

        </div>

        <div class="buttons_container">
          <input type="submit" id="submit" value="MODIFICA" class="btn-submit">
          <a href="{{ route("admin.restaurants.products.show", $product->slug) }}">
            <button type="button" class="btn_back">INDIETRO</button>
          </a>
        </div>
      </form>
    </div>

  </section>
@endsection
