 <form method="post" id="payment-form" action="{{ route('checkout') }}" style="width: 30%;">
    @csrf
    @method("POST")

    <section>
        <label for="total_price">
            <span class="input-label">Amount</span>
            <div class="input-wrapper amount-wrapper">
                <input id="total_price" name="total_price" type="tel" min="1" placeholder="Amount" value="{{number_format($order['total_price'],3)}}" hidden>
                <span>{{ number_format($order['total_price'], 2)." €" }}</span>
            </div>
        </label>

        <div class="bt-drop-in-wrapper">
            <div id="bt-dropin"></div>
        </div>
    </section>
    
    <input type="text" name="guest_name">
    <input type="text" name="guest_address">
    <div>
    @foreach ($order as $key => $value)
        <input type="text" name="{{ $key }}" value="{{ $value }}" hidden>
    @endforeach

    </div>
    <input id="nonce" name="payment_method_nonce" type="hidden" />
    <button class="button" type="submit" onclick=" window.localStorage.clear()"><span>Test Transaction</span></button>
</form>
