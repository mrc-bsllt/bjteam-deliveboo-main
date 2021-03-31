@extends('layouts.backend')

@section("main")
  <div id="dashboard_index" class="container">

    <div class="dashboard_top_section">

      <ul class="dashboard_top_container_cards">

        <li class="dashboard_top_card">
          <div class="dashboard_top_card_icon">
            <i class="fas fa-store"></i>
          </div>
          <p>{{$restaurant->name}}</p>
        </li>
        <li class="dashboard_top_card" id="first-child">
          <div class="dashboard_top_card_icon">
            <i class="fas fa-wallet"></i>
          </div>
          <p>Fatturato Totale: {{ number_format($totalEarnings, 2) }}&euro;</p>
        </li>
        <li class="dashboard_top_card">
          <div class="dashboard_top_card_icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <p>{{$restaurant->address}}</p>
        </li>

      </ul>

    </div>

    <div class="dashboard_middle_section">
      <ul class="dashboard_middle_container_cards">

        <li class="dashboard_middle_card" id="first-child">
          <div class="dashboard_middle_card_icon">
            <p>Ultimi Ordini</p>
          </div>
          <div class="dashboard_container_orders">
            @foreach (array_reverse($orders) as $item)
            <div class="dashboard_item dashbord_order"><span class="badge badge-success">{{$item->created_at->format('H:i:s')}}</span> - Order n° {{ $item->order_number }}</div>
            @endforeach
          </div>
        </li>
        <li class="dashboard_middle_card">
          <div class="dashboard_middle_card_icon">
            <p>Ultimi aggiornamenti menù</p>
          </div>
          <div class="dashboard_container_plates">
            @foreach ($restaurant->products->reverse() as $key => $product)
              @if($key === $restaurant->products->count() - 1)
              <p class="dashboard_item">{{ $product->name }} <span class="badge badge-danger">new</span></p>
              @else
              <p class="dashboard_item">{{ $product->name }}</p>
              @endif
            @endforeach
          </div>
        </li>

      </ul>
    </div>

  </div>

@endsection
