@extends('layouts.backend')

@section('main')
  <div id="admin_product_show">

    <div class="product_show_container">
      <div class="image_box">
        {{-- immagine del prodotto --}}
        @if ($product->image == null)
          <img src="{{asset('img/foods-placeholder-600x600.png')}}" alt="{{$product->name}}">
        @else
          <img src="{{ $product->image }}" alt="{{$product->name}}">
        @endif

        {{-- box verde con nome del prodotto --}}
        <div class="green_name_box">
          <h3>{{$product->name}}</h3>
        </div>

        {{-- box arancione con il link alla edit del prodotto --}}
        <div class="orange_icon_box">
          <a href="{{ route("admin.restaurants.products.edit", $product->id) }}">
            <i class="fas fa-edit"></i>
          </a>
        </div>

        {{-- box giallo con icona is_vegetarian --}}
        @if ($product->is_vegetarian)
          <div class="is_vegetal_box">
            <i class="fab fa-envira"></i>
          </div>
        @endif

        @if ($product->is_glutenfree)
          {{-- box rosso con icona is_glutenfree --}}
          <div class="gluten_free_box">
            <i class="fas fa-bread-slice"></i>
          </div>
        @endif
      </div>

      <div class="description_box">
        <p>{{ $product->description }}</p>

        <div class="price_box">
          <small>{{ $product->price }}&euro;</small>
        </div>
      </div>

      <div class="buttons_container">
        <a href="{{ route("admin.restaurants.products.index") }}">
          <button type="button" class="btn_back">INDIETRO</button>
        </a>
      </div>
    </div>
    {{-- <div class="my-3">
      <a class="btn btn-primary" href="{{route('admin.restaurants.products.index')}}">
        <i class="fas fa-chevron-circle-left"></i> Tutti i prodotti
      </a>
      <a class="btn btn-warning" href="{{route('admin.restaurants.products.edit', $product->id)}}">
        <i class="fas fa-pencil-alt"></i> Modifica prodotto
      </a>
    </div>


    <table class="table table-striped table-bordered">
      <tbody>
        <tr>
          <th>Immagine</th>

          <td>
            @if ($product->image == null)
              <img height="180px" src="{{asset('img/foods-placeholder-600x600.png')}}" alt="{{$product->name}}">
            @elseif(substr($product->image, 0, 5) == 'https')
              <img src="{{ $product->image }}" alt="" style="width: 100px">
            @else
              <img height="180px" src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}">
            @endif
          </td>

        </tr>
        <tr>
          <th>Nome piatto</th>
          <td>{{$product->name}}</td>
        </tr>
        <tr>
          <th>Ingredienti</th>
          <td>{{$product->description}}</td>
        </tr>
        <tr>
          <th>Prezzo</th>
          <td>{{number_format($product->price, 2). ' €'}}</td>
        </tr>
        <tr>
          <th>Vegetariano</th>
          <td>{{$product->is_vegetarian ? "SI" : "NO"}}</td>
        </tr>
        <tr>
          <th>Senza Glutine</th>
          <td>{{$product->is_glutenfree ? "SI" : "NO"}}</td>
        </tr>
        <tr>
          <th>Creato il</th>
          <td>{{$product->created_at->format('d-m-Y')}}</td>
        </tr>
      </tbody>
    </table> --}}

  </div>

@endsection
