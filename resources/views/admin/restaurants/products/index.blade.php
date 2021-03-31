@extends('layouts.backend')

@section('main')

  @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
  @endif

  {{-- <h1>{{ Auth::user()->restaurant->name }}</h1>
  @foreach (Auth::user()->restaurant->categories as $category)
    <span class="badge badge-info">{{ $category->name }}</span>
  @endforeach --}}

  <div class="card_title">
    <h1>{{ Auth::user()->restaurant->name }} menù</h1>
    <div class="menu_icon">
      <i class="fas fa-utensils"></i>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row">
      
      @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <a class="card_link" href="{{ route('admin.restaurants.products.show', $product->slug) }}">
            <div class="card">
              <div class="card_image">
                @if(substr($product->image, 0, 6) == 'images')
                  <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                  <img src="{{ $product->image }}" alt="">
                @endif
                <div class="my_btn position">
                  <i class="fas fa-eye"></i>
                </div>
              </div>
  
              <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p>{{ substr($product->description, 0, 20).'...' }}</p>
                
              </div>

              <a class="my_edit_btn" href="{{ route('admin.restaurants.products.edit', $product->id) }}">
                <i class="fas fa-pencil-alt"></i>
              </a>

              <div class="delete_product">
                <form action="{{ route('admin.restaurants.products.destroy', $product->id) }}" method="post" onclick="return confirm('Sei sicuro?')">
                  @csrf
                  @method('DELETE')
                  <button class="my_delete_btn" type="submit"><i class="fas fa-trash-alt"></i></button>
                </form>
              </div>

            </div>
          </a>

          {{-- <div class="product">
            <img src="{{ $product->image }}" alt="">
          </div> --}}
         
        </div>
        
      @endforeach
    </div>

    <div class="my_buttons">
      <a class="my_dashboard_btn" href="{{ route('admin.restaurants.dashboard') }}" class="my_dashboard_btn">Torna alla dashboard</a>
      <a href="{{ route('admin.restaurants.products.create') }}" class="my_create_btn">Aggiungi piatto</a>
    </div>
    
  </div>

 
    



    {{-- <a class="btn btn-primary" href="{{ route('admin.restaurants.products.create') }}">Aggiungi un nuovo piatto</a>
    <a class="btn btn-danger" href="{{ route('admin.restaurants.dashboard') }}">BACK</a> --}}

@endsection
