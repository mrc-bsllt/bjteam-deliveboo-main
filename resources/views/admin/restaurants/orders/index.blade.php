@extends('layouts.backend')

@section('main')
    <div id="dashboard_order">

        <div class="card_title">
            <h1>{{ Auth::user()->restaurant->name }} Ordini</h1>
            <div class="menu_icon">
                <i class="far fa-chart-bar dashboard-icon"></i>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card_orders">
                            <div class="card_order">
                                <div class="card_left">
                                    <p>Ordine N. {{ $order->order_number }}</p>                      
                                </div>
                                
                                <div class="card_right">
                                    <p>Ordinato da: <strong>{{ $order->guest_name }}</strong></p>
                                    <p>All'indirizzo: <strong>{{ $order->guest_address }}</strong></p>
                                    <p>In data: <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></p>
                                    <p>status Pagamento: <strong>{{ $order->status}}</strong></p>
                                    <p>Prezzo: <strong>{{ number_format($order->total_price, 2) }}</strong>&euro;</p>
                                    @if($order->counter != null)
                                        @php
                                          $order->counter = explode(",", $order->counter);
                                        @endphp
                                        <strong style="display: block; margin: 15px">Prodotti ordinati:</strong>
                                        @for($i = 0; $i < count($order->products); $i++)
                                            <p>{{ $order->products[$i]->name }} x{{ $order->counter[$i] }}</p>
                                        @endfor
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>  
                @endforeach
            </div>
            <div class="my_buttons">
                <a class="my_dashboard_btn" href="{{ route('admin.restaurants.dashboard') }}" class="my_dashboard_btn">Torna alla dashboard</a>
                <a class="my_create_btn" href="{{ route("admin.restaurants.orders.chart") }}">Grafico</a>
            </div>  
        </div>

    </div>
    {{-- @if(auth()->check())
      <script>
          window.User = {!! auth()->user()  !!}
          console.log(window.User);
      </script>
      @endif --}}

@endsection
